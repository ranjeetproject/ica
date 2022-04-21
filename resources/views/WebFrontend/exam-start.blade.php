@extends('WebFrontend.layout.afterLoginApp')
@section('content')
    <section class="header">
        <div class="header-top">
            @include('WebFrontend.layout.afterLoginHeaderTop')
        </div>
        <div class="header-bottom">
            @include('WebFrontend.layout.afterLoginNav')
        </div>
    </section>
    <section class="exam-list-wr">
        <div class="container">
            <div class="innertitle modf_heading">
                <h3 class="e-title">
                    <span class="blue-bar addbar"></span>
                    {{ $examName }}
                    <span class="blue-bar"></span>
                </h3>
                <div class="dateoption">
                    <div class="dateinfo"><span>Date : </span><strong> {{ date('d-m-Y') }}</strong></div>
                    <div class="timeinfo"><span class="clockimg"><img src="{{asset('css/images/clockimg.png')}}" alt="">
                        </span> <strong id="countdown"> </strong> <span> Remaining</span></div>
                </div>
            </div>
        </div>


        <div class="inner_content_info">
            <div class="inner_content_view">
                <div class="inner_block" id="questionHolder">
                    <div class="load-more" style="display:none">
                        <img src="{{ asset('css/images/Spinner-1s-43px.gif') }}" class="img-fluid"/>
                    </div>
                </div>

                <div class="def_btn_opt morebtn_info">
                    <a class="def_btn prevbtn" href="javascript:void(0);" onclick="previousQuestion();">Previous</a>
                    <a href="javascript:void(0);" class="def_btn" onclick="nextQuestion();">Skip</a>
                    <a class="def_btn nextbtn" href="javascript:void(0);" onclick="nextQuestion();">Next</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJavascript')

    <script>
        var examId = '{{ $id }}';
        let page = 1;
        let lastPage = 1;
        let url = "{{ action('WebFrontend\ExamController@examStart', ['id' => $id]) }}";
        $(function () {
            fetch_data();
        });


        function fetch_data() {
            $.ajax({
                url: url + '?page=' + page,
                method: "GET",
                beforeSend: function () {
                    $('#allPostLoader').show();
                }
            })
                .done(function (response) {
                    $('#questionHolder').html(response.html);
                    page = response.page;
                    lastPage = response.last_page;
                })
        }

        function previousQuestion() {
            let innetPage = (page - 2);
            if (innetPage > 0) {
                $.ajax({
                    url: url + '?page=' + innetPage,
                    method: "GET",
                    beforeSend: function () {
                        $('.load-more').show();
                    }
                })
                    .done(function (response) {
                        $('#questionHolder').html(response.html);
                        page = response.page;
                    })
            } else {
                alert('No More question for previous');
            }
        }


        function previousQuestion() {
            let innetPage = (page - 2);
            if (innetPage > 0) {
                $.ajax({
                    url: url + '?page=' + innetPage,
                    method: "GET",
                    beforeSend: function () {
                        $('.load-more').show();
                    }
                })
                    .done(function (response) {
                        $('#questionHolder').html(response.html);
                        page = response.page;
                    })
            } else {
                Swal.fire('No more question for previous')
                //alert('No More question for previous');
            }
        }




        function nextQuestion() {
            if (lastPage >= page) {
                $.ajax({
                    url: url + '?page=' + page,
                    method: "GET",
                    beforeSend: function () {
                        $('.load-more').show();
                    }
                })
                    .done(function (response) {
                        $('#questionHolder').html(response.html);
                        page = response.page;
                    })
            } else {
                Swal.fire('No more question for skip or next')
                //alert('No More question for skip or next');
            }
        }

        const startingMinuites = '{{ $duration }}';
        let time = startingMinuites * 60;

        const countdownEl = document.getElementById('countdown')
        //console.log(countdownEl)
        const interval = setInterval(updateCountdown, 1000);

        function updateCountdown() {
            const minute = Math.floor(time / 60);
            let second = time % 60

            countdownEl.innerText = `${(minute < 10) ? '0' + minute : minute}: ${(second < 10) ? '0' + second : second}`
            if (time == 0) {
                Swal.fire('Time is over')
                clearInterval(interval)
            } else {
                time--
            }

        }

    </script>

@endsection

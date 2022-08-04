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
        <div class="container" id="comp-exam-data">
            <h3 class="e-title">
                Competitive Exam list
                <span class="blue-bar"></span>
            </h3>
            @foreach ($data as $key=>$exam)
                <div class="list-item">
                    <span>{{$key+1}}</span>
                    <a class="nav-link" href="{{url('competitive-exam-instruction',$exam->ex_id)}}">
                        <p>{{$exam->exam_name}}</p>
                    </a>
                </div>
            @endforeach 
 
             
            
           <!--  {{-- <nav aria-label="...">
                {{$comExam->links('WebFrontend.custom-competitive-exam-pagination')}} 
            </nav> --}} -->
        </div>
        <!-- <div class="col-md-12">
                <div class="load-more" style="display:none">
                    <img src="{{ asset('css/images/loadmore-icon.png') }}" class="img-fluid" />
                    <p>Load more...</p>
                </div>
            </div> -->
    </section>
@endsection





















{{-- @extends('WebFrontend.layout.afterLoginApp')
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
        <div class="container" id="comp-exam-data">
            <h3 class="e-title">
                Competitive Exam list
                <span class="blue-bar"></span>
            </h3>
            
             
            
            {{-- <nav aria-label="...">
                {{$comExam->links('WebFrontend.custom-competitive-exam-pagination')}} 
            </nav> --}}
        {{-- </div>
        <div class="col-md-12">
                <div class="load-more" style="display:none">
                    <img src="{{ asset('css/images/loadmore-icon.png') }}" class="img-fluid" />
                    <p>Load more...</p>
                </div>
            </div>
    </section> --}}
{{-- @endsection  --}}
{{-- @section('customJavascript') --}}
{{-- <script>
        let page = 1;
        let lastPage = 10;
        let scroll = false;

        $(function () {
            loadMoreData(page);
            $(window).on('scroll', onScroll);
        });

        //this are used for users post load on page scroll
        function onScroll() {
            //console.log('page')
            var trackScroll = $(window).scrollTop() + window.innerHeight >= document.body.scrollHeight
            if (trackScroll) {
                if (lastPage >= page && scroll) {
                    loadMoreData(page);
                }
            }
        }

        function loadMoreData(pageNumber) {
            scroll = false;
            let url = "{{ action('WebFrontend\ExamController@competitiveExam') }}";
            $.ajax({
                    url: url + '?page=' + pageNumber,
                    type: "get",
                    beforeSend: function() {
                        $('.load-more').show();
                    }
                })
                .done(function(data) {
                    if (data.html != "") {
                        $("#comp-exam-data").append(data.html);
                        $('.load-more').hide();
                        page++;
                        lastPage = data.last_page;
                        scroll = true;
                    } else {
                        $('.load-more').html("No more records found");
                        return;
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    scroll = true
                    alert('server not responding...');
                });
        }
</script> --}}


{{-- @endsection --}}
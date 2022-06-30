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
    <!-- end header -->

    <section class="course-header">
        <div class="container">
            <p class="courses-title">Courses</p>
        </div>
    </section>
    <section class="couses-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('view-all-my-courses')}}" class="btn view-all" style="float:right;margin-bottom:20px;color:white">View All Courses</a>
                </div>
            </div>
            <div class="row" id="course-data">                
            </div>
            
            <div class="col-md-12">
                <div class="load-more" style="display:none">
                    <img src="{{ asset('css/images/loadmore-icon.png') }}" class="img-fluid" />
                    <p>Load more...</p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJavascript')
    <script>
        let currentPage = 1;
        let scroll = false;
        let lastPage=10;

        $(function () {
            loadMoreData(currentPage);
            $(window).on('scroll', onScroll);
        });

        function onScroll() {
            var trackScroll = $(window).scrollTop() + window.innerHeight >= document.body.scrollHeight
            if (trackScroll) {
                if (lastPage >= currentPage && scroll) {
                    console.log("On scroll :"+currentPage);
                    loadMoreData(currentPage);
                }
            }
        }

        function loadMoreData(page) 
        {
            scroll = false;
            $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function() {
                        $('.load-more').show();
                    }
                })
                .done(function(data) {
                    if (data.html != "") {
                        $("#course-data").append(data.html);
                        $('.load-more').hide();
                        currentPage++;
                        lastPage = data.last_page;
                        scroll = true;
                    } else {
                        $('.load-more').html("No more records found");
                        return;
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }
    </script>
@endsection

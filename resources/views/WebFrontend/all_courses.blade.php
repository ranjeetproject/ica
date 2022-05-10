@extends((\Auth::check())?'WebFrontend.layout.afterLoginApp':'WebFrontend.layout.app')
@section('content')
    @if(Auth::check())
        <section class="header">
            <div class="header-top">
                @include('WebFrontend.layout.afterLoginHeaderTop')
            </div>
            <div class="header-bottom">
                @include('WebFrontend.layout.afterLoginNav')
            </div>
        </section>
    @else
        @include('WebFrontend.layout.previousLoginNav')
    @endif

    <section class="banner-wrp" style="background: url('https://demos.mydevfactory.com/android/public/cms_images/{{@$homeCms->featured_image}}') no-repeat top right background-size: contain;;
">
    <img src="{{asset('css/images/dot-group-top.png')}}" class="img-fluid top_icon" alt="#">
    <div class="ban-content">
        <h1 class="cont-head">
            Over <span>20,000+ </span>online
            courses & <span>1000+</span> Quizes
            from best instructor
        </h1>
        <p class="cont-para">
            Iste Natus Error sit Voluptatem Accusantium....
        </p>
        <div class="but-wrap">
            <img src="{{asset('css/images/point-arrow.svg')}}" class="img-fluid point-arrow" alt="#">
            <img src="{{asset('css/images/dot-group.png')}}" class="img-fluid bottom_icon" alt="#">
            <a href="{{route('login')}}" class="btn common-button">Explore All Courses</a>
        </div>
    </div>
</section>
     <section class="allCourse">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2><strong>All Courses</strong></h2>
                    <div class="allCourseBlock" id="course-data">
                        @include('WebFrontend.all_courses_pagination')
                        <div class="col-md-12">
                            <div class="load-more" style="display:none">
                                <img src="{{ asset('css/images/loadmore-icon.png') }}" class="img-fluid" />
                                <p>Load more...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>









@endsection
@section('customJavascript')
    <script>
        function loadMoreData(page) {
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
                    } else {
                        $('.load-more').html("No more records found");
                        return;
                    }

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }

        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() + 50 >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
    </script>
@endsection
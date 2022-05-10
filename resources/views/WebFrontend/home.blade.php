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
<!-- end banner -->

<section class="how-it-works">
    <div class="container">
        <div class="h-header-wrp">
            <p>How it Works</p>
            <h3>Adipisci velit, Sed quia non Numquam Eius Modi quia non
                Eum iure Reprehende</h3>
        </div>
        <div class="h-cards-wrp">
            <div class="card">
                <span class="count-no">1</span>
                <img src="{{asset('css/images/how-connector.png')}}" alt="#" class="img-fluid conntector" />
                <div class="card-body">
                    <img src="{{asset('css/images/how-it-icon-1.svg')}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">Numquam veli</h4>
                        <p>Don numq modi</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <span class="count-no">2</span>
                <img src="{{asset('css/images/how-connector.png')}}" alt="#" class="img-fluid conntector" />
                <div class="card-body">
                    <img src="{{asset('css/images/how-it-icon-2.svg')}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">Numquam veli</h4>
                        <p>Don numq modi</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <span class="count-no">3</span>
                <img src="{{asset('css/images/how-connector.png')}}" alt="#" class="img-fluid conntector" />
                <div class="card-body">
                    <img src="{{asset('css/images/how-it-icon-3.svg')}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">Numquam veli</h4>
                        <p>Don numq modi</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <span class="count-no">4</span>
                <div class="card-body">
                    <img src="{{asset('css/images/how-it-icon-4.svg')}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">Numquam veli</h4>
                        <p>Don numq modi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end how it works -->

<section class="courses-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <p class="courses-tag">Courses </p>
                <h2 class="course-head"> There are the following 20+ courses under depertment.</h2>
            </div>
            <div class="col-md-7">
                <p class="corse-hints">Iste natus error sit Voluptatem Accusantium doloremque laudantium Nemo
                    usantium dolore Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit, sed do eiusmod tempo rincididunt ut labore et dolore magna aliqua.
                    Quis suspendisse
                    onsectetur adipiscing.</p>
            </div>
        </div>
        <div class="home-courses">
            @foreach($courses as $value)
            <div class="course-card">
                @if($value->course_photo == null)
                <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#" />
                @else
                <img src="{{$value->course_photo}}" class="course-image" alt="#" />
                @endif
                <div class="total-lesson">
                    <img src="{{asset('css/images/lesson-icon.png')}}" class="img-flid" alt="#">
                    <span>{{$value->lessons->count()}} Lessons</span>
                </div>
                <h4 class="course-name">{{$value->course_name}}
                </h4>
                <div class="rating">
                    @if($value->rating == 0.5 || $value->rating == 1.5 || $value->rating == 2.5 || $value->rating == 3.5 || $value->rating == 4.5)
                        @for($i=0 ; $i<$value->rating-1 ; $i++)
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
                        @endfor
                        <img src="{{asset('css/images/outline-star.svg')}}" class="img-flid">
                    @else
                        @for($i=0 ; $i<$value->rating ; $i++)
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
                        @endfor
                    @endif
                    <span>4.50({{$value->stdCount}})</span>
                </div>
                <div class="course-by-wrp">
                    @if($value->user->profile_image == null)
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    @else
                    <img src="{{$value->user->profile_image}}" class="ins-avt" alt="#" />
                    @endif
                    <div class="avt-name">
                        <span>by</span>
                        {{$value->user->name}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="view-all-course">
            <a href="{{route('all-courses')}}" class="btn common-button">View All Courses</a>
        </div>
    </div>
</section>
<!-- end course-wrap -->
<section class="courses-wrap testimonials">
    <div class="container">
        <div class="top-head">
            <p class="courses-tag">Testimonials </p>
            <h2 class="course-head">The cleaners came within
                the timeframe
            </h2>
        </div>

        <div class="home-courses">
            @foreach($testimonial as $value)
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>{{$value->title}}</h3>
                    {!!$value->description!!}
                </div>
                <div class="course-by-wrp">
                    <img src="https://demos.mydevfactory.com/android/public/testimonial_images/{{$value->user_image}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> {{$value->username}}</label>
                        <p class="desg">{{$value->designation}}</p>
                    </div>

                </div>
            </div>
            @endforeach
            <!-- <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="./images/inst-avatar.png" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div> -->
        </div>
        <div class="view-all-course">
            <a href="#" class="btn common-button">View All</a>
        </div>
    </div>
</section>

@endsection

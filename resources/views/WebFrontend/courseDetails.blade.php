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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Course</a></li>
                    <li class="breadcrumb-item"><a href="#">Business Accounting</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="javascript:void(0)">Introduction</a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="crs-dtls-wrp">
        <div class="container">
            <div class="video-wrp">
                <img src="{{asset('css/images/video-banner.png')}}" alt="#" class="img-fluid" />
                <button class="btn btnplay">
                    <img src="{{asset('css/images/play-icon.svg')}}" class="img-fluid" />
                </button>
            </div>

            <div class="contents">
                <p class="sub-para">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                    porro quisquam est, qui dolorem ipsum
                    quia dolor sit amet, Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                    laboriosam, nisi ut
                    aliquid ex ea commodi consequatur....</p>
                <p class="para-text">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                    porro quisquam est, qui dolorem ipsum
                    quia dolor sit amet, Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                    laboriosam, nisi ut
                    aliquid ex ea commodi consequatur....</p>
                <div class="title-part">
                    <span>About Courses</span>
                    <span class="bar"></span>
                </div>
                <p class="para-text">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                    porro quisquam est, qui dolorem ipsum
                    quia dolor sit amet, Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                    laboriosam, nisi ut
                    aliquid ex ea commodi consequatur....</p>

                <ul class="nav about-list">
                    <li class="nav-item">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        Neque porro quisquam est, qui dolorem ipsum
                        quia dolor sit amet, Ut enim ad minima veniam.</li>
                    <li class="nav-item">Dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem ipsum quia dolor sit amet, Ut
                        enim ad minima veniam.</li>
                    <li class="nav-item">Ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem
                        ipsum.
                    </li>
                </ul>
                <div class="title-part">
                    <span>Modules</span>
                    <span class="bar"></span>

                    <div class="rating-star">
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-fluid" />
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-fluid" />
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-fluid" />
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-fluid" />
                        <img src="{{asset('css/images/outline-star.svg')}}" class="img-fluid" />
                        <span>-4.33(3)</span>
                    </div>
                </div>
                <div class="module-content">
                    <span class="count-number">1</span>
                    <p>Minima veniam, quis nostrum Exercitationem ullam Corpori</p>
                    <div class="lesson-prt">
                        <img src="{{asset('css/images/lesson-icon.png')}}" class="img-fluid" />
                        <span class="lesson-number">10 Lessons</span>
                    </div>
                </div>
                <div class="module-content">
                    <span class="count-number">1</span>
                    <p>Minima veniam, quis nostrum Exercitation.</p>
                    <div class="lesson-prt">
                        <img src="{{asset('css/images/lesson-icon.png')}}" class="img-fluid" />
                        <span class="lesson-number">10 Lessons</span>
                    </div>
                </div>
                <div class="module-content">
                    <span class="count-number">1</span>
                    <p>Quis nostrum Exercitationem ullam Corpori</p>
                    <div class="lesson-prt">
                        <img src="{{asset('css/images/lesson-icon.png')}}" class="img-fluid" />
                        <span class="lesson-number">10 Lessons</span>
                    </div>
                </div>
                <p class="para-text mb-0">
                    Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                    qui dolorem ipsum
                    quia dolor sit amet, Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                    laboriosam, nisi ut
                    aliquid ex ea commodi consequatur....</p>
            </div>
        </div>
    </section>
@endsection

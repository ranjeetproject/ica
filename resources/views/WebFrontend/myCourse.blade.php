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
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                        <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Business Accounting </h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                        <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Business Accounting </h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                        <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Live Projects</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Budge! 2020</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Tally</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Business Accounting </h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Business Accounting </h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Live Projects</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Budge! 2020</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Tally</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Budge! 2020</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="course-card">
                         <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
                        <h4 class="course-name">Tally</h4>
                        <button class="btn view">view</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="load-more">
                        <img src="{{asset('css/images/loadmore-icon.png')}}" class="img-fluid" />
                        <p>Load more...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

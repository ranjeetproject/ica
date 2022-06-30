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
                @foreach ($data as $courses)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="course-card">
                            @if($courses->course_photo !='')
                                <img src="{{$courses->course_photo}}" class="course-image" alt="#">
                            @else
                                <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="exam-image">
                            @endif
                            <h4 class="course-name">{{$courses->course_name}} </h4>
                            <a href="{{ url('course-details', $courses->course) }}" class="btn view">view</a>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>
@endsection


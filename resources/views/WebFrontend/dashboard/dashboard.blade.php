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

    <section class="banner-wrp db-banner" style="background: url('https://demos.mydevfactory.com/android/public/cms_images/{{@$dashboardCms->featured_image}}') no-repeat top right;
">
        <img src="{{ asset('css/images/dot-group-top.png') }}" class="img-fluid top_icon" alt="#">
        <div class="ban-content">
            <h1 class="cont-head">
                Welcome <span>to </span>Learnersmall <span>!!! Your Digital </span> Classroom
            </h1>
            <p class="cont-para">
                Learn the Courses with Fun.......
            </p>
            <div class="but-wrap">
                <img src="{{ asset('css/images/dot-group.png') }}" class="img-fluid bottom_icon" alt="#">
            </div>
        </div>
    </section>
    <!-- end banner -->

    <section class="db-block1 bg-1">
        <div class="container">
            <div class="row" id="courseHolder">
                <div class="col-md-12">
                    <div class="db-top-part">
                        <h3 class="title">My Course</h3>
                        <a href="{{route('my-courses')}}" class="btn view-all">View all</a>
                    </div>
                </div>
                <div class="col-md-12" id="courseLoader" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                
                {{-- @foreach ($courses as $course)
                    <div class="col-md-4">
                        <div class="course-card db-cards">
                            @if ($course['course_photo'] != null)
                                <img src="{{ $course['course_photo'] }}" class="course-image" alt="#">
                            @else
                                <img src="{{ asset('css/images/course-image.jpg') }}" class="course-image" alt="#">
                            @endif
                            <div class="title-w-icon">
                                <h4 class="course-name">{{ $course['course_name'] }} </h4>
                                <a href="{{url('course-details', $course['course'])}}">
                                    <img src="{{ asset('css/images/plus-icon.svg') }}" class="img-fluid" />
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            </div>

        </div>
    </section>
    <!-- end My Course -->
    <section class="db-block1 exam">
        <div class="container">
            <div class="row" id="examHolder">
                <div class="col-md-12">
                    <div class="db-top-part">
                        <h3 class="title">My Exam</h3>
                        <a href="{{route('my-exam')}}" class="btn view-all">View all</a>
                    </div>
                </div>
                <div class="col-md-12" id="examLoader" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                {{-- @foreach ($exams as $exam)
                    <div class="col-md-4">
                        <div class="course-card db-cards">                            
                            <img src="{{ asset('css/images/course-image.jpg') }}" class="course-image" alt="#">                           
                            <div class="total-lesson">
                                <img src="{{ asset('css/images/lesson-icon.png') }}" class="img-flid" alt="#">
                                <span>{{ $exam->exam_code }}</span>
                            </div>
                            <div class="title-w-icon">
                                <h4 class="course-name">
                                    {{ $exam->exam_name }}    
                                </h4>
                                <a href="#">
                                    <img src="{{ asset('css/images/plus-icon.svg') }}" class="img-fluid" />
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            </div>

        </div>
    </section>
    <!-- end My exam -->

    <div class="progress-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="progress-sec">
                        <h4>Progress</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="progress-custom yellow">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">90%</div>
                                </div>
                                <p class="grade-level">Grade 3</p>
                            </div>
                            <div class="col-md-6">
                                <div class="cat-progress">
                                    <span class="v-percentage">25%</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Wordpress</div>
                                    </div>
                                </div>

                                <div class="cat-progress">
                                    <span class="v-percentage">55%</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 55%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Marketing</div>
                                    </div>
                                </div>
                                <div class="cat-progress">
                                    <span class="v-percentage">30%</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 30%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </div>
                                <div class="cat-progress">
                                    <span class="v-percentage">60%</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 60%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Business Accounting
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="total-completed">
                            198 / 250 Passed
                        </p>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="award-part">
                        <h4>Awards</h4>
                        <label class="result-label">Check Your Result</label>
                        <div class="search-input">
                            <input type="text" class="form-control" placeholder="Enrollment no" />
                            <button class="btn search">
                                <img src="{{ asset('css/images/search-icon.svg') }}" class="img-fluid">
                            </button>
                        </div>
                        <div class="search-res">
                            <span><img src="{{ asset('css/images/winner-icon.svg') }}"></span>
                            <p class="tests">Top 100 ICA History</p>
                            <button class="btn add-icon">
                                <img src="{{ asset('css/images/plus-icon-green.svg') }}" class="img-fluid" /></button>
                        </div>
                        <div class="search-res">
                            <span><img src="{{ asset('css/images/winner-icon.svg') }}"></span>
                            <p class="tests">Top 100 ICA History</p>
                            <button class="btn add-icon">
                                <img src="{{ asset('css/images/plus-icon-green.svg') }}" class="img-fluid" /></button>
                        </div>
                        <div class="search-res">
                            <span><img src="{{ asset('css/images/winner-icon.svg') }}"></span>
                            <p class="tests">Top 100 ICA History</p>
                            <button class="btn add-icon">
                                <img src="{{ asset('css/images/plus-icon-green.svg') }}" class="img-fluid" /></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJavascript')
<script>
    var afterLogin={{$afterLogin}};
    var courseUrl='{{action('WebFrontend\DashboardController@dashboardCourseDisplay')}}';
    var examUrl='{{action('WebFrontend\DashboardController@dashboardExamDisplay')}}';
    if(afterLogin==1){
        Swal.fire({
            title: 'Are you sure want to setup your Courses and Exams',
            text: "New Courses & Exam are tagged for you",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Process it!'
        }).then((result) => 
            {
                if (result.isConfirmed) 
                {
                    loadCoursesData(1); 
                    loadExamsData(1); 
                }
                else{
                    loadCoursesData(); 
                    loadExamsData();
                }
            });
    }
    else
    {
        loadCoursesData(); 
        loadExamsData();
    }


    function loadCoursesData(type=0) 
    {
        $.ajax({
                url: courseUrl+'?type='+type,
                type: "get",
                beforeSend: function() {
                    $("#courseLoader").show();
                }
            })
            .done(function(data) 
            {
                if (data.html != "") {
                    $("#courseHolder").append(data.html);
                    $("#courseLoader").hide();
                } 
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
            });
    }
    function loadExamsData(type=0) 
    {
        $.ajax({
                url: examUrl+'?type='+type,
                type: "get",
                beforeSend: function() {
                    $("#examLoader").show();
                }
            })
            .done(function(data) 
            {
                if (data.html != "") {
                    $("#examHolder").append(data.html);
                    $("#examLoader").hide();
                } 
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
            });
    }

</script>
@endsection

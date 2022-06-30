<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}" href="{{action('WebFrontend\DashboardController@dashboardPageDisplay')}}">Dashboard </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(1) == 'about-us') ? 'active' : '' }}" href="{{action('WebFrontend\CmsController@aboutUs')}}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(1) == 'contact-us') ? 'active' : '' }}" href="{{action('WebFrontend\CmsController@contactUs')}}">Contact Us </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(1) == 'my-courses') ? 'active' : '' }}" href="{{action('WebFrontend\CourseController@myCourses')}}">My Course </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(1) == 'my-exam') ? 'active' : '' }}" href="{{route('my-exam')}}">Exams </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(1) == 'competitive-exam') ? 'active' : '' }}" href="{{action('WebFrontend\ExamController@competitiveExam')}}">Competitive</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{action('WebFrontend\CourseController@academicDetailsFetch')}}">Acedemic Details</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{action('WebFrontend\RankHistoryController@rankHistoryList')}}">My Rank</a>
                </li> --}}
            </ul>
            <div class="follow-us">
                <span>Follow us</span>
                <a href="{{$setting_data->footer_facebook}}" class="social-link" target="_blank">
                    <img src="{{asset('css/images/fb-icon.svg')}}" class="img-fluid" /></a>
                <a href="{{$setting_data->footer_twitter}}" class="social-link" target="_blank"><img src="{{asset('css/images/twitter-icon.svg')}}"
                                                     class="img-fluid" /></a>
                <a href="{{$setting_data->footer_pinterest}}" class="social-link" target="_blank"><img src="{{asset('css/images/pinterest-icon.svg')}}"
                                                     class="img-fluid" /></a>
                <a href="{{$setting_data->linkedin}}" class="social-link" target="_blank"><img src="{{asset('css/images/Linkedin-icon.svg')}}"
                                                     class="img-fluid" /></a>
                <a href="{{$setting_data->youtube}}" class="social-link" target="_blank"><img src="{{asset('css/images/youtube-icon.svg')}}"
                                                     class="img-fluid" /></a>
            </div>
        </div>
    </div>
</nav>

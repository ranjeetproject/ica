<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{action('WebFrontend\DashboardController@dashboardPageDisplay')}}">Dashboard </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{action('WebFrontend\CmsController@aboutUs')}}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{action('WebFrontend\CmsController@contactUs')}}">Contact Us </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{action('WebFrontend\CourseController@myCourses')}}">My Course </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('my-exam')}}">Exams </a>
                </li>
            </ul>
            <div class="follow-us">
                <span>Follow us</span>
                <a href="#" class="social-link">
                    <img src="{{asset('css/images/fb-icon.svg')}}" class="img-fluid" /></a>
                <a href="#" class="social-link"><img src="{{asset('css/images/twitter-icon.svg')}}"
                                                     class="img-fluid" /></a>
                <a href="#" class="social-link"><img src="{{asset('css/images/pinterest-icon.svg')}}"
                                                     class="img-fluid" /></a>
                <a href="#" class="social-link"><img src="{{asset('css/images/Linkedin-icon.svg')}}"
                                                     class="img-fluid" /></a>
                <a href="#" class="social-link"><img src="{{asset('css/images/youtube-icon.svg')}}"
                                                     class="img-fluid" /></a>
            </div>
        </div>
    </div>
</nav>

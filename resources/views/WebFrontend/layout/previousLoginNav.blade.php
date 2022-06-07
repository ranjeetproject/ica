<section class="header">
    <div class="header-top">
        <div class="container">
            <div class="top-cont">
                <div class="lt-prt">
                    <div class="log-ar">
                        <a href="{{action('WebFrontend\HomePageController@homePageDisplay')}}" >
                        <img class="img-fluid" src="{{asset('css/images/logo.svg')}}" alt="logo" /></a>
                        <div class="text-part">Learner<span>small</span></div>
                    </div>
                    <div class="std-qt">study that gives you success</div>
                </div>
                <div class="rt-prt">
		  <a href="{{route('contactUs')}}" class="social-link">
                    <img src="{{asset('css/images/q-mark.svg')}}" class="img-fluid" /></a>
		  <a href="{{$setting_data->video_link}}" class="social-link" target="_blank">
                    <img src="{{asset('css/images/video-icon.svg')}}" class="img-fluid" /></a>
                    <a href="{{action('WebFrontend\UserController@loginForm')}}" class="login-btn">Login</a>
                    <div class="free-sec">
                        <img src="{{asset('css/images/free-icon.svg')}}" class="img-fluid" />
                        <span class="regis"><a href="{{action('WebFrontend\UserController@signUp')}}">registration</a></span>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                   height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->segment(1) == '') ? 'active' : '' }}" href="{{action('WebFrontend\HomePageController@homePageDisplay')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->segment(1) == 'about-us') ? 'active' : '' }}" href="{{action('WebFrontend\CmsController@aboutUs')}}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->segment(1) == 'contact-us') ? 'active' : '' }}" href="{{action('WebFrontend\CmsController@contactUs')}}">Contact Us</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">More</a>
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
    </div>

</section>
<!-- end header -->

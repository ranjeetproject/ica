<div class="container">
    <div class="top-cont">
        <div class="lt-prt">
            <div class="log-ar">
                <a href="{{action('WebFrontend\HomePageController@homePageDisplay')}}" >
                <img class="img-fluid" src="{{ asset('css//images/logo.svg') }}" alt="logo" /></a>
                <div class="text-part">Student<span>Home page</span></div>
            </div>
            <div class="std-qt">study that gives you success</div>
        </div>
        <div class="rt-prt">
	<a href="{{route('contactUs')}}" class="social-link">
            <img src="{{ asset('css/images/q-mark.svg') }}" class="img-fluid" /></a>
	<a href="{{$setting_data->video_link}}" class="social-link" target="_blank">
            <img src="{{ asset('css/images/video-icon.svg') }}" class="img-fluid" /></a>
            <div class="notification-wrp">
                <span class="num">1</span>
                <img src="{{ asset('css/images/bell_icon.svg') }}" class="img-fluid" />
            </div>
            <div class="profile">
            @if(Auth::user()->profile_image!='')
                <img src="{{Auth::user()->profile_image}}" alt="profile_image"/>
            @else
                <img src="{{asset('css/images/profile-avatar.jpg')}}" alt="profile_image"/>
            @endif
                <div class="dropdown">
                    <a class="btn name-link  dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{action('WebFrontend\DashboardController@profilePage')}}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{action('WebFrontend\UserController@logout')}}">Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- responsive toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg></span>
            </button>
        </div>
    </div>
</div>

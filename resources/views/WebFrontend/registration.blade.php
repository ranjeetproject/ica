@extends('WebFrontend.layout.app')
@section('content')
    <section class="header">
        <div class="header-top">
            <div class="container">
                <div class="top-cont">
                    <div class="lt-prt">
                        <div class="log-ar">
                            <img class="img-fluid" src=".{{asset('css/images/logo.svg')}}" alt="logo"/>
                            <div class="text-part">Student<span>Home page</span></div>
                        </div>
                        <div class="std-qt">study that gives you success</div>
                    </div>
                    <div class="rt-prt">
                        <img src="{{asset('css/images/q-mark.svg')}}" class="img-fluid"/>
                        <img src="{{asset('css/images/video-icon.svg')}}" class="img-fluid"/>
                        <a href="#" class="login-btn">Login</a>
                        <div class="free-sec">
                            <img src="{{asset('css/images/free-icon.svg')}}" class="img-fluid"/>
                            <span class="regis">registration</span>
                        </div>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                   height="16" fill="currentColor" class="bi bi-list"
                                                                   viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
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
                                <a class="nav-link active" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">More</a>
                            </li>
                        </ul>
                        <div class="follow-us">
                            <span>Follow us</span>
                            <a href="#" class="social-link">
                                <img src="{{asset('css/images/fb-icon.svg')}}" class="img-fluid"/></a>
                            <a href="#" class="social-link"><img src="{{asset('css/images/twitter-icon.svg')}}"
                                                                 class="img-fluid"/></a>
                            <a href="#" class="social-link"><img src="{{asset('css/images/pinterest-icon.svg')}}"
                                                                 class="img-fluid"/></a>
                            <a href="#" class="social-link"><img src="{{asset('css/images/Linkedin-icon.svg')}}"
                                                                 class="img-fluid"/></a>
                            <a href="#" class="social-link"><img src="{{asset('css/images/youtube-icon.svg')}}"
                                                                 class="img-fluid"/></a>
                        </div>
                    </div>
            </nav>
        </div>

    </section>
    <!-- end header -->

    <section class="signup-wrapper">
        <div class="signup-container">
            <div class="sig-card-wpr">
                <div class="content-part">
                    <div class="cont-inner">
                        <h5>Mastemind Better</h5>
                        <h3>Succeed</h3>
                        <h4>Together</h4>
                        <p>Iste Natus Error sit Voluptatem Accusantium
                            Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae
                            consequatur, vel illum qui
                            dolor...</p>
                    </div>
                </div>
                <div class="form-part">
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-left"/>
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-right"/>
                    <img src="{{asset('css/images/linear-circle.png')}}" class="bottom-left"/>
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-top-right"/>
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-left-bottom"/>

                    <div class="snup-logo-wrap">
                        <img src="{{asset('css/images/logo-signup.png')}}" class="snup-logo" alt="#">
                        <div class="s-content">
                            <h3>Create an <span>account</span></h3>
                            <p>Iste Natus Error sit Voluptatem AccusantiumQuis autem
                                eum iure reprehenderit qui in ea vol.....</p>
                        </div>
                    </div>
                    <form class="form" method="post" action="{{ url('/registration') }}"> 
                        @csrf
                        <div class="mb-3">
                            <input type="Name" class="form-control" placeholder="Name" id="name" name="name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email ID" id="email" name="email" required>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Mobile Number" id="mobile" name="mobile" required>
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Address" id="address" name="address" required>
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="state">
                                <option>State</option>
                                <option value="West Bengal">West Bengal</option>
                                <option value="Jharkhand">Jharkhand</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="City" id="city" name="city">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Pincode" id="pincode" name="pincode">
                            @if ($errors->has('pincode'))
                                <span class="text-danger">{{ $errors->first('pincode') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn signup">Procceed</button>
                    </form>

                    <p class="already-account">Already have an account? <a href="#"> LOGIN</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection

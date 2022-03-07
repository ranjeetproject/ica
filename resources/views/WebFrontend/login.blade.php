@extends('WebFrontend.layout.app')
@section('content')
    <section class="header">
        <div class="header-top">
            <div class="container">
                <div class="top-cont">
                    <div class="lt-prt">
                        <div class="log-ar">
                            <img class="img-fluid" src="{{asset('css/images/logo.svg')}}" alt="logo" />
                            <div class="text-part">Student<span>Home page</span></div>
                        </div>
                        <div class="std-qt">study that gives you success</div>
                    </div>
                    <div class="rt-prt">
                        <img src="{{asset('css/images/q-mark.svg')}}" class="img-fluid" />
                        <img src="{{asset('css/images/video-icon.svg')}}" class="img-fluid" />
                        <a href="{{route('ica-login')}}" class="login-btn">Login</a>
                        <div class="free-sec">
                            <img src="{{asset('css/images/free-icon.svg')}}" class="img-fluid" />
                            <span class="regis">registration</span>
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
            </nav>
        </div>

    </section>
    <!-- end header -->
    <section class="signup-wrapper login-wrapper">
        <div class="signup-container">
            <div class="sig-card-wpr">
                <div class="content-part">
                    <div class="cont-inner">
                        <ul class="nav flex-direction">
                            <li class="nav-item">
                                <div class="num">1</div>
                                <span>ICA Students, use your student code</span>
                            </li>
                            <li class="nav-item">
                                <div class="num">2</div>
                                <span>Tutor Regitered Students, please put the code provided by your tutor</span>
                            </li>
                            <li class="nav-item">
                                <div class="num active">3</div>
                                <span>Other students, please use the system generated code</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-part">
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-left" />
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-right" />
                    <img src="{{asset('css/images/linear-circle.png')}}" class="bottom-left" />
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-top-right" />
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-left-bottom" />

                    <div class="snup-logo-wrap">
                        <img src="{{asset('css/./images/logo-signup.png')}}" class="snup-logo" alt="#">
                        <div class="s-content">
                            <h3>Other Students<span>login</span></h3>
                            <p>Iste Natus Error sit Voluptatem AccusantiumQuis autem
                                eum iure reprehenderit qui in ea vol.....</p>
                        </div>
                    </div>
                    <form class="form" id="loginForm">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="code" placeholder="User ID" id="code">
                        </div>

                        <div class="mb-3">
                            <input type="number" class="form-control" name="mobile_number" placeholder="Mobile Number" id="mobile_number">
                        </div>

                        <div class="otp-wrap">
                            <p> OTP is sent to your Mobile number</p>
                            <div class="time">
                                <span>00:40</span>
                                <button type="submit" class="btn reqOtp" id="sendOtp">
                                    Request OTP
                                </button>
                            </div>
                        </div>
                        <div class="mb-3 verify-otp">
                            <input type="text" class="form-control" placeholder="Address">
                            <button class="btn reqOtp">
                                Verify OTP
                            </button>
                        </div>

                        <button type="submit" class="btn signup">Login</button>
                    </form>
                    <p class="already-account"> </p>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJavascript')
    <script>
    
    $("#sendOtp").click(function(e){
        e.preventDefault()
            var baseUrl='{{route("send-otp")}}';
            $.ajax({
                type: 'POST',
                url: baseUrl,
                data: {
                    _token: "{{csrf_token()}}",
                    code:$("#code").val(),
                    mobile_number:$("#mobile_number").val()
                },
                success: function (data)
                {
                    
                }
            });

    })
   
            $('#loginForm').validate({
                rules: {
                    
                    code: {
                        required: true
                    },
                    mobile_number: {
                        required: true
                    },
                   
                },
                messages: {
                   
                    code: {
                        required: "This user id field is required."
                    },
                    mobile_number: {
                        required: "This mobile number field is required."
                    }
                },
                errorElement: "span",
                errorClass: "form-text text-danger is-invalid"
            });
            $('#loginForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        
    </script>
@endsection

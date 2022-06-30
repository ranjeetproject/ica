@extends((\Auth::check())?'WebFrontend.layout.afterLoginApp':'WebFrontend.layout.app')
@section('content')
    @if(Auth::check())
        <section class="header">
            <div class="header-top">
                @include('WebFrontend.layout.afterLoginHeaderTop')
            </div>
            <div class="header-bottom">
                @include('WebFrontend.layout.afterLoginNav')
            </div>
        </section>
    @else
        @include('WebFrontend.layout.previousLoginNav')
    @endif

    <section class="banner-wrp inner-banner" style="
    background: url(https://demos.mydevfactory.com/android/public/cms_images/{{$featured_image}}) no-repeat top right;
"> 
        <img src="{{asset('css/images/dot-group-top.png')}}" class="img-fluid top_icon" alt="#">
        <div class="ban-content">
            <h1 class="cont-head">
                We are always <span>happy to Help !!!</span> Get in touch with us today......
            </h1>
            <p class="cont-para">
                Ready to assist you anytime, anywhere.
            </p>
            <div class="but-wrap">
                <img src="{{asset('css/images/dot-group.png')}}" class="img-fluid bottom_icon" alt="#">
            </div>
        </div>
    </section>

<section class="contact_info">
        <div class="crs-dtls-wrp">
            <div class="container contents">
                <div class="contactfrom_details">
                    <div class="contactfrom_left footer-wrapper">
                        <div class="title-part">
                            <span>Contact  Address</span>
                        </div>
                        <div class="add-bar">
                            <img src="{{asset('css/images/location-icon.svg')}}" class="add-icon">
                            <div class="label">
                                <span>{{$setting_data->footer_address}}</span>
                            </div>
                        </div>
                       
                        <div class="add-bar">
                            <img src="{{asset('css/images/envelop-icon.svg')}}" class="add-icon">
                            <div class="label">
                               
                                <a href="mailto: jasonlokau@gmail.oom">
                                    {{$setting_data->footer_email}}
                                </a>
                            </div>
                        </div>
                        <div class="add-bar">
                            <img src="{{asset('css/images/call-icon.svg')}}" class="add-icon">
                            <div class="label">
                                <a href="tel:+160 4825 6769">
                                    {{$setting_data->footer_phone}}</a>
                            </div>
                        </div>
                       {{-- {!!@$content!!} --}}
                    </div>
                    <div class="contactfrom_right">
                        <div class="title-part">
                            <span>{{@$page_name}}</span>
                            <span class="bar"></span>
                        </div>
                        <form class="form contactfrom" method="post" action="{{ url('/submit-query') }}" id="contactUsForm">
                            @csrf
                        <div class="mb-3">
                            <input type="Name" class="form-control" placeholder="Name" id="name" name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email ID" id="email" name="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Mobile Number" id="mobile" name="mobile">
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject">
                            @if ($errors->has('subject'))
                                <span class="text-danger">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <textarea name="message" cols="30" rows="10" class="form-control" placeholder="Enter your Message" id="message"></textarea>
                            @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                            
                    
                            <button type="submit" class="btn signup">Send</button>
                        </form>
                    </div>
                </div>
              
            </div>
        </div>
    </section>

    <div class="add_banner">
        <img src="{{asset('css/images/add.jpg')}}" class="img-fluid bottom_icon" alt="#">

    </div>


    <!-- <section class="signup-wrapper">
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
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-left" />
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-right" />
                    <img src="{{asset('css/images/linear-circle.png')}}" class="bottom-left" />
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-top-right" />
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-left-bottom" />

                    <div class="snup-logo-wrap">
                        <img src="{{asset('css/images/logo-signup.png')}}" class="snup-logo" alt="#">
                        <div class="s-content">
                            <h3>Ready to <span> Get Started?
                            </span></h3>
                            <p>Iste Natus Error sit Voluptatem AccusantiumQuis autem
                                eum iure reprehenderit qui in ea vol.....</p>
                        </div>
                    </div>
                    <form class="form" method="post" action="{{ url('/submit-query') }}" id="contactUsForm">
                        @csrf
                        <div class="mb-3">
                            <input type="Name" class="form-control" placeholder="Name" id="name" name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email ID" id="email" name="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Mobile Number" id="mobile" name="mobile">
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject">
                            @if ($errors->has('subject'))
                                <span class="text-danger">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <textarea name="message" cols="30" rows="10" class="form-control" placeholder="Enter your Message" id="message"></textarea>
                            @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn signup">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </section> -->

@endsection
@section('customJavascript')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
<script>
    $('#contactUsForm').validate({
        rules: {

            name: {
                required: true
            },
            email: {
                required: true
            },
            mobile: {
                required: true
            },
            subject: {
                required: true
            },
            message: {
                required: true
            }
        },
        messages: {

            name: {
                required: "This name field is required."
            },
            email: {
                required: "Email field is required"
            },
            mobile: {
                required: "Mobile No field is required"
            },
            subject: {
                required: "Subject field is required"
            },
            message: {
                required: "Message is required"
            }
        },
        errorElement: "span",
        errorClass: "form-text text-danger is-invalid"
    });
    $('#contactUsForm').submit(function () {
        $("#error_code").html('');
        $('button[type=submit]').attr("disabled", true);
        setTimeout(function () {
            $('button[type=submit]').attr("disabled", false);
        }, 3000);
    });
</script>
<script>
   @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        {{ Session::forget('success') }};
  @endif


  @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
  @endif


  @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
  @endif


  @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
  @endif
</script>
@endsection

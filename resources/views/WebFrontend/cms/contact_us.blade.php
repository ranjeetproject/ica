@extends((\Auth::check())?'WebFrontend.layout.afterLoginApp':'WebFrontend.layout.app')
@section('content')

@include((\Auth::check())?'WebFrontend.layout.afterLoginNav':'WebFrontend.layout.previousLoginNav')

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
    </section>

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
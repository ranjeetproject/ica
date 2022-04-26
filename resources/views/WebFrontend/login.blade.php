@extends('WebFrontend.layout.app')
@section('content')
@include('WebFrontend.layout.previousLoginNav')
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
                @if (session('error'))
                <div class="alert loginAlert" id="error-login">
                    {{ session('error') }}
                </div>
                @endif
                <span id="success_message" class="successs" style="color:#ed0f12;padding:10px;"></span>
                <form class="form" action={{action('WebFrontend\UserController@postLogin')}} method="POST" id="loginForm">
                    {{csrf_field()}}
                    <div class="mb-3 otpReqsec">
                        <input type="text" class="form-control" name="code" placeholder="Your Code" id="code">
                        <span id="error_code" style="color:#ed0f12;padding:10px;"></span>
                        <span id="otp_success_message" style="color:#82ff80;padding:10px;"></span>
                        <span id="otp_error_message" style="color:#ed0f12;padding:10px;"></span>
      
                        <button type="button" class="btn reqOtp" id="sendOtp">
                            Request OTP <img src="{{ asset('css/images/Spinner-1s-23px.gif') }}" class="img-fluid" id="sendOtp-loader"  style="display:none"/>
                        </button>
                        <div class="otp-wrap">
                            {{-- <p id="otp-msg"> </p> --}}
                            <div class="time">{{-- <span>00:40</span> --}}</div>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                            <input type="number" class="form-control" name="mobile_number" placeholder="Mobile Number"
                                   id="mobile_number">
                            <span id="error_mobile_number" style="color:#ed0f12;padding:10px;"></span>
                        </div> --}}










                    <!--
<div class="otp-wrap">
    {{-- <p id="otp-msg"> </p> --}}
    <div class="reqOtpbg">
        <span id="otp_success_message" style="color:#008000;padding:10px;"></span>
        <span id="otp_error_message" style="color:#ed0f12;padding:10px;"></span>
    </div>
    <div class="time">
        {{-- <span>00:40</span> --}}
        <button type="button" class="btn reqOtp" id="sendOtp">
            Request OTP
        </button>
    </div>
</div>
-->






                    <div class="mb-3 verify-otp">
                        <input type="text" class="form-control" name="verify_Otp" placeholder="OTP" id="verify_Otp">
                        <button type="button" class="btn reqOtp" id="verifyOtp">
                            Verify OTP<img src="{{ asset('css/images/Spinner-1s-23px.gif') }}" class="img-fluid" id="verifyOtp-loader"  style="display:none"/>
                        </button>
                        <div class="verifyOtptxt">
                            <span id="error_verify_ot" style="color:#ed0f12;padding:10px;"></span>
                            <span id="verify_success_message" style="color:#82ff80;padding:10px;"></span>
                            <span id="verify_error_message" style="color:#ed0f12;padding:10px;"></span>
                        </div>
                    </div>
                    <div class="load-more" style="margin-left:72%;position:absolute;margin-top:14px;display:none">
                        <img src="{{ asset('css/images/Spinner-1s-50px.gif') }}" class="img-fluid" />
                    </div>
                    <button type="submit" class="btn signup">Login</button>
                </form>
                <p class="already-account"></p>

            </div>
        </div>
    </div>
</section>
@endsection
@section('customJavascript')
<script>
    $("#sendOtp").click(function(e) {
        $('#sendOtp-loader').show();
        $("#code-error").html('');
        //$("#mobile_number-error").html('');
        $("#verify_Otp-error").html('');
        if ($("#code").val() == '' || $("#code").val() == undefined) {
            $("#error_code").html('This your code field is required.');
            $('#sendOtp-loader').hide();
            return false;
        } else {
            $("#error_code").html('');
        }

        /* if ($("#mobile_number").val() == '' || $("#mobile_number").val() == undefined) {
             $("#error_mobile_number").html('This mobile number field is required.');
             return false;
         } else {
             $("#error_mobile_number").html('');
         }*/
        e.preventDefault()
        var dataVal = {
            "_token": "{{ csrf_token() }}",
            "code": $("#code").val(),
            //"mobile_number": $("#mobile_number").val()
        }
        var baseUrl = '{{route("send-otp")}}';
        $.ajax({
            type: 'POST',
            url: baseUrl,
            data: dataVal,
            success: function(data) {
                if (data.status == true) {
                    $("#otp_success_message").html(data.message);
                    setTimeout(function() {
                        $('#otp_success_message').html('');
                    }, 3000);
                     $('#sendOtp-loader').hide();
                } else {
                    $("#otp_error_message").html(data.error);
                    
                    setTimeout(function() {
                        $('#otp_error_message').html('');
                    }, 3000);
                    $('#sendOtp-loader').hide();

                    
                }
            }
        });

    });


    $("#verifyOtp").click(function(e) {
        $('#verifyOtp-loader').show();
        $("#code-error").html('');
        
        $("#verify_Otp-error").html('');
        if ($("#code").val() == '' || $("#code").val() == undefined) {
            $("#error_code").html('This your code field is required.');
             $('#verifyOtp-loader').hide();
            return false;
        }else{
            $("#error_code").html('');
        }
        if ($("#verify_Otp").val() == '' || $("#verify_Otp").val() == undefined) {
            $("#error_verify_ot").html('This otp field is required.');
            $('#verifyOtp-loader').hide();
            return false;
        }else{
            $("#error_verify_ot").html('');
        }

        e.preventDefault()
        var dataVal = {
            "_token": "{{ csrf_token() }}",
            "code": $("#code").val(),
            //"mobile_number": $("#mobile_number").val(),
            "verify_Otp": $("#verify_Otp").val()

        }
        var baseUrl = '{{route("verify-otp")}}';
        $.ajax({
            type: 'POST',
            url: baseUrl,
            data: dataVal,
            success: function(data) {
                if (data.status == true) {
                    $("#verify_success_message").html(data.message);
                    setTimeout(function() {
                        $('#verify_success_message').html('');
                    }, 3000);
                    $('#verifyOtp-loader').hide();
                } else {
                    $("#verify_error_message").html(data.message);
                    setTimeout(function() {
                        $('#verify_error_message').html('');
                    }, 3000);
                    $('#verifyOtp-loader').hide();
                }
            }
        });

    });

    $('#loginForm').validate({
        rules: {

            code: {
                required: true
            },
            verify_Otp: {
                required: true
            }

        },
        messages: {

            code: {
                required: "This your code field is required."
            },
            verify_Otp: {
                required: "This otp field is required."

            }
        },
        errorElement: "span",
        errorClass: "form-text text-danger is-invalid"
    });
    $('#loginForm').submit(function() {
        $('.load-more').show();
        $("#error_code").html('');
        //$('button[type=submit]').attr("disabled", true);
        setTimeout(function() {
           $('button[type=submit]').attr("disabled", false);
            $("#error-login").hide();
        }, 3000);
    });
    
    setTimeout(function() {
        $("#error-login").hide();
        $('.load-more').hide();
    }, 3000);
   

</script>
@endsection

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
                            <span>Enter your Student Code and Login (for ICA Students)</span>
                        </li>
                        <li class="nav-item">
                            <div class="num">2</div>
                            <span>Enter your Contact Number (for Non-ICA Students)</span>
                        </li>
                        <li class="nav-item">
                            <div class="num active">3</div>
                            <span>Enter your Code provided by Tutor/College (for Tutor/College Students)</span>
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
                        <h3>Learnersmall <span>Login</span></h3>
                        <p>Enter the Student Code provided by ICA and request for OTP.</p>
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
                        <span class="form-text text-danger"
                                                      id="error_code">{{ $errors->getBag('default')->first('code') }}</span>
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
                            <span class="form-text text-danger"
                                                      id="error_verify_Otp">{{ $errors->getBag('default')->first('verify_Otp') }}</span>
                        </div>
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
        $('#sendOtp').attr("disabled", true);
        $("#code-error").html('');
        //$("#mobile_number-error").html('');
        $("#verify_Otp-error").html('');
        if ($("#code").val() == '' || $("#code").val() == undefined) {
            $("#error_code").html('This your code field is required.');
            $('#sendOtp-loader').hide();
             $('#sendOtp').attr("disabled", false);
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
                     $('#sendOtp').attr("disabled", false);
                } else {
                    $("#otp_error_message").html(data.error);
                    
                    setTimeout(function() {
                        $('#otp_error_message').html('');
                    }, 3000);
                    $('#sendOtp-loader').hide();
                    $('#sendOtp').attr("disabled", false);

                    
                }
            }
        });

    });


    $("#verifyOtp").click(function(e) {
        $('#verifyOtp-loader').show();
        $('#verifyOtp').attr("disabled", true);
        $("#code-error").html('');
        
        $("#verify_Otp-error").html('');
        if ($("#code").val() == '' || $("#code").val() == undefined) {
            $("#error_code").html('This your code field is required.');
             $('#verifyOtp-loader').hide();
             $('#verifyOtp').attr("disabled", false);
            return false;
        }else{
            $("#error_code").html('');
        }
        if ($("#verify_Otp").val() == '' || $("#verify_Otp").val() == undefined) {
            $("#error_verify_ot").html('This otp field is required.');
            $('#verifyOtp-loader').hide();
            $('#verifyOtp').attr("disabled", false);
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
                    $('#verifyOtp').attr("disabled", false);
                } else {
                    $("#verify_error_message").html(data.message);
                    setTimeout(function() {
                        $('#verify_error_message').html('');
                    }, 3000);
                    $('#verifyOtp-loader').hide();
                    $('#verifyOtp').attr("disabled", false);
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
       
        $("#error_code").html('');
        $('button[type=submit]').attr("disabled", true);
        $('#sendOtp').attr("disabled", true);
        $('#verifyOtp').attr("disabled", true);
        $('#code,#verify_Otp').keyup(function() {
            if($(this).val() != '') {
                $('button[type="submit"]').attr('disabled', false);
            }
     });
    });
    
    setTimeout(function() {
        $("#error-login").hide();
       // $('button[type=submit]').attr("disabled", false);
        
    }, 3000);
   

</script>
@endsection

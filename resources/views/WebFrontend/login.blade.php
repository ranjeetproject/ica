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
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-left"/>
                    <img src="{{asset('css/images/linear-circle.png')}}" class="top-right"/>
                    <img src="{{asset('css/images/linear-circle.png')}}" class="bottom-left"/>
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-top-right"/>
                    <img src="{{asset('css/images/dot-group.png')}}" class="dot-left-bottom"/>

                    <div class="snup-logo-wrap">
                        <img src="{{asset('css/./images/logo-signup.png')}}" class="snup-logo" alt="#">
                        <div class="s-content">
                            <h3>Other Students<span>login</span></h3>
                            <p>Iste Natus Error sit Voluptatem AccusantiumQuis autem
                                eum iure reprehenderit qui in ea vol.....</p>
                        </div>
                    </div>
                    <span id="success_message" style="color:#ed0f12;padding:10px;"></span>
                    <form class="form" action={{action('WebFrontend\UserController@postLogin')}} method="POST" id="loginForm">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <input type="text" class="form-control" name="code" placeholder="User ID" id="code">
                            <span id="error_code" style="color:#ed0f12;padding:10px;"></span>
                        </div>

                        <div class="mb-3">
                            <input type="number" class="form-control" name="mobile_number" placeholder="Mobile Number"
                                   id="mobile_number">
                            <span id="error_mobile_number" style="color:#ed0f12;padding:10px;"></span>
                        </div>

                        <div class="otp-wrap">
                            <p id="otp-msg"> </p>
                            <div class="time">
                                {{-- <span>00:40</span> --}}
                                <button type="button" class="btn reqOtp" id="sendOtp">
                                    Request OTP
                                </button>
                            </div>
                        </div>
                        <span id="verify_success_message" style="color:#008000;padding:10px;"></span>
                        <span id="verify_error_message" style="color:#ed0f12;padding:10px;"></span>
                        <div class="mb-3 verify-otp">
                            <input type="text" class="form-control" name="verify_Otp" placeholder="OTP" id="verify_Otp">
                            <button type="button" class="btn reqOtp" id="verifyOtp">
                                Verify OTP
                            </button>
                            <span id="error_verify_ot" style="color:#ed0f12;padding:10px;"></span>

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

        $("#sendOtp").click(function (e) {
            $("#code-error").html('');
            $("#mobile_number-error").html('');
            $("#verify_Otp-error").html('');
            if ($("#code").val() == '' || $("#code").val() == undefined) {
                $("#error_code").html('This user id field is required.');
                return false;
            } else {
                $("#error_code").html('');
            }

            if ($("#mobile_number").val() == '' || $("#mobile_number").val() == undefined) {
                $("#error_mobile_number").html('This mobile number field is required.');
                return false;
            } else {
                $("#error_mobile_number").html('');
            }
            e.preventDefault()
            var dataVal = {
                "_token": "{{ csrf_token() }}",
                "code": $("#code").val(),
                "mobile_number": $("#mobile_number").val()
            }
            var baseUrl = '{{route("send-otp")}}';
            $.ajax({
                type: 'POST',
                url: baseUrl,
                data: dataVal,
                success: function (data) {
                    if (data.status == true) {
                        $("#otp-msg").html(data.message);
                        setTimeout(function () {
                            $('#otp-msg').html('');
                        }, 3000);
                    } else {
                        $("#success_message").html(data.error);
                        setTimeout(function () {
                            $('#success_message').html('');
                        }, 3000);
                    }
                }
            });

        });


        $("#verifyOtp").click(function (e) {
            $("#code-error").html('');
            $("#mobile_number-error").html('');
            $("#verify_Otp-error").html('');
            if ($("#code").val() == '' || $("#code").val() == undefined) {
                $("#error_code").html('This user id field is required.');
                return false;
            } else {
                $("#error_code").html('');
            }

            if ($("#mobile_number").val() == '' || $("#mobile_number").val() == undefined) {
                $("#error_mobile_number").html('This mobile number field is required.');
                return false;
            } else {
                $("#error_mobile_number").html('');
            }

            if ($("#verify_Otp").val() == '' || $("#verify_Otp").val() == undefined) {
                $("#error_verify_ot").html('This verify otp field is required.');
                return false;
            } else {
                $("#error_verify_ot").html('');
            }

            e.preventDefault()
            var dataVal = {
                "_token": "{{ csrf_token() }}",
                "code": $("#code").val(),
                "mobile_number": $("#mobile_number").val(),
                "verify_Otp": $("#verify_Otp").val()

            }
            var baseUrl = '{{route("verify-otp")}}';
            $.ajax({
                type: 'POST',
                url: baseUrl,
                data: dataVal,
                success: function (data) {
                    if (data.status == true) {
                        $("#verify_success_message").html(data.message);
                        setTimeout(function () {
                            $('#verify_success_message').html('');
                        }, 3000);
                    } else {
                        $("#verify_error_message").html(data.message);
                        setTimeout(function () {
                            $('#verify_error_message').html('');
                        }, 3000);
                    }
                }
            });

        });

        $('#loginForm').validate({
            rules: {

                code: {
                    required: true
                },
                mobile_number: {
                    required: true
                },
                verify_Otp: {
                    required: true
                }

            },
            messages: {

                code: {
                    required: "This user id field is required."
                },
                mobile_number: {
                    required: "This mobile number field is required."
                },
                verify_Otp: {
                    required: "This verify otp field is required."

                }
            },
            errorElement: "span",
            errorClass: "form-text text-danger is-invalid"
        });
        $('#loginForm').submit(function () {
            $("#error_code").html('');
            $('button[type=submit]').attr("disabled", true);
            setTimeout(function () {
                $('button[type=submit]').attr("disabled", false);
            }, 3000);
        });
    </script>
@endsection

@extends('WebFrontend.layout.app')
@section('content')
    @include('WebFrontend.layout.previousLoginNav')

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
                    <form class="form" method="post" action="{{ url('/registration') }}" id="registrationForm">

                        @csrf
                        <div class="mb-3">
                            <input type="Name" class="form-control" placeholder="Name" id="name" name="name" value="{{ old('name') }}">
                            <p style="display: none;" id="nameError">Name is required</p>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email ID" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Mobile Number" id="mobile" name="mobile" value="{{ old('mobile') }}">
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Address" id="address" name="address" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="state">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{$state->name_sort}}" {{old ('state') == $state->name_sort ? 'selected' : ''}}>{{$state->name_long}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('state'))
                                <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="City" id="city" name="city" value="{{ old('city') }}">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Pincode" id="pincode" name="pincode" value="{{ old('pincode') }}">
                            @if ($errors->has('pincode'))
                                <span class="text-danger">{{ $errors->first('pincode') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn signup">Procceed</button>
                    </form>

                    <p class="already-account">Already have an account? <a href="{{route('login')}}"> LOGIN</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJavascript')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
<script>
        $('#registrationForm').validate({
            rules: {

                name: {
                    required: true
                },
                email: {
                    required: true,
                    remote: '{{route("checkEmailIsPresentOrNot")}}'
                },
                mobile: {
                    required: true,
                    remote: '{{route("checkMobileIsPresentOrNot")}}'
                },
                address: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                pincode: {
                    required: true
                }

            },
            messages: {

                name: {
                    required: "This name field is required."
                },
                email: {
                    required: "Email field is required",
                    remote: "Email is already taken"
                },
                mobile: {
                    required: "Mobile No field is required",
                    remote: "Mobile No is already registered with us"
                },
                address: {
                    required: "Address field is required"
                },
                state: {
                    required: "State is required"
                },
                city: {
                    required: "City field is required"
                },
                pincode: {
                    required: "Pincode is required"
                }
            },
            errorElement: "span",
            errorClass: "form-text text-danger is-invalid"
        });
        $('#registrationForm').submit(function () {
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
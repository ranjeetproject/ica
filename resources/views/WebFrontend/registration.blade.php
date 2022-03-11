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

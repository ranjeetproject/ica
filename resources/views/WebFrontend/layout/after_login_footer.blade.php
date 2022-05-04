<section class="footer-wrapper">
    <div class="container">
        <div class="social-wrap">
            <div class="footer-logo-wrap">
                <img src="{{ asset('css/images/logo-footer.svg') }}" class="footer-logo" alt="#" />
                <p class="text-prt">{!!$setting_data->footer_text!!}</p>

                <a href="{{action('WebFrontend\CmsController@aboutUs')}}" class="btn btn-about">About us</a>
            </div>
            <div class="footer-address">
                <h6 class="fo-head">Get in touch</h6>
                <div class="add-bar">
                    <img src="{{ asset('css/images/location-icon.svg') }}" class="add-icon">
                    <div class="label">
                        <label>Address:</label>
                        <span>{{$setting_data->footer_address}}</span>
                    </div>
                </div>
                <div class="add-bar">
                    <img src="{{ asset('css/images/call-icon.svg') }}" class="add-icon">
                    <div class="label">
                        <label>Phone:</label>
                        <a href="tel:+160 4825 6769">
                            {{$setting_data->footer_phone}}</a>
                    </div>
                </div>
                <div class="add-bar">
                    <img src="{{ asset('css/images/envelop-icon.svg') }}" class="add-icon">
                    <div class="label">
                        <label>Email:</label>
                        <a href="mailto: jasonlokau@gmail.oom">
                            {{$setting_data->footer_email}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-quick-links">
                <h6 class="fo-head">Quick Links</h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('WebFrontend\CmsController@aboutUs')}}"><img src="{{ asset('css/images/footer-arrow.png') }}">
                            About
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('WebFrontend\CmsController@contactUs')}}"><img src="{{ asset('css/images/footer-arrow.png') }}">
                            Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('WebFrontend\CmsController@termsAndCondition')}}"><img src="{{ asset('css/images/footer-arrow.png') }}">
                            Terms
                            &
                            Conditions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('WebFrontend\CmsController@privacyPolicy')}}"><img src="{{ asset('css/images/footer-arrow.png') }}"> Privacy
                            Policy</a>
                    </li>
                </ul>
            </div>
            <div class="footer-so-li">
                <h6 class="fo-head">Social Links</h6>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{$setting_data->footer_facebook}}" class="quick-links-social" target="_blank">
                            <img src="{{ asset('css/images/footer-fb-icon.svg') }}" class="f-social-icon" alt="#" />
                            Facebook &nbsp;&nbsp;&nbsp;
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$setting_data->footer_twitter}}" class="quick-links-social" target="_blank">
                            <img src="{{ asset('css/images/footer-twitter-icon.svg') }}" class="f-social-icon"
                                alt="#" />
                            Twitter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$setting_data->footer_pinterest}}" class="quick-links-social" target="_blank">
                            <img src="{{ asset('css/images/footer-pint-icon.svg') }}" class="f-social-icon"
                                alt="#" />
                            Pinterest&nbsp;&nbsp;
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$setting_data->footer_instagram}}" class="quick-links-social" target="_blank">
                            <img src="{{ asset('css/images/footer-insta-icon.svg') }}" class="f-social-icon"
                                alt="#" />
                            Instagram
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            2020 - 2022 <a href="http://www.icajobguarante">http://www.icajobguarante</a>
        </div>
    </div>
</section>

<script src="{{ asset('js/WebFrontend/jquery.js') }}"></script>
<script src="{{ asset('js/WebFrontend/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/WebFrontend/slick.js') }}"></script>
<script src="{{ asset('js/WebFrontend/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/cropperjs"></script>
@yield('customJavascript')
</body>

</html>

<section class="footer-wrapper">
    <div class="container">
        <div class="social-wrap">
            <div class="footer-logo-wrap">
                <img src="{{asset('css/images/logo-footer.svg')}}" class="footer-logo" alt="#"/>
                <p class="text-prt">Sectetur, adipisci velit, sed quia non numquam esectetur, adipisci velit, sed
                    quia
                    non numquam..</p>

                <a href="#" class="btn btn-about">About us</a>
            </div>
            <div class="footer-address">
                <h6 class="fo-head">Get in touch</h6>
                <div class="add-bar">
                    <img src="{{asset('css/images/location-icon.svg')}}" class="add-icon">
                    <div class="label">
                        <label>Address:</label>
                        <span>Teum iure reprehenderit qui in<br>
                                eaderit qui in, Canada</span>
                    </div>
                </div>
                <div class="add-bar">
                    <img src="{{asset('css/images/call-icon.svg')}}" class="add-icon">
                    <div class="label">
                        <label>Phone:</label>
                        <a href="tel:+160 4825 6769">
                            +160 4825 6769</a>
                    </div>
                </div>
                <div class="add-bar">
                    <img src="{{asset('css/images/envelop-icon.svg')}}" class="add-icon">
                    <div class="label">
                        <label>Email:</label>
                        <a href="mailto: jasonlokau@gmail.oom">
                            jasonlokau@gmail.oom
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-quick-links">
                <h6 class="fo-head">Quick Links</h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('css/images/footer-arrow.png')}}"> About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('css/images/footer-arrow.png')}}"> Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{asset('css/images/footer-arrow.png')}}"> Terms &
                            Conditions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><img src="{{asset('css/images/footer-arrow.png')}}"> Privacy Policy</a>
                    </li>
                </ul>
            </div>
            <div class="footer-so-li">
                <h6 class="fo-head">Social Links</h6>
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="quick-links-social">
                            <img src="{{asset('css/images/footer-fb-icon.svg')}}" class="f-social-icon" alt="#"/>
                            Facebook &nbsp;&nbsp;&nbsp;
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="quick-links-social">
                            <img src="{{asset('css/images/footer-twitter-icon.svg')}}" class="f-social-icon" alt="#"/>
                            Twitter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="quick-links-social">
                            <img src="{{asset('css/images/footer-pint-icon.svg')}}" class="f-social-icon" alt="#"/>
                            Pinterest&nbsp;&nbsp;
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="quick-links-social">
                            <img src="{{asset('css/images/footer-insta-icon.svg')}}" class="f-social-icon" alt="#"/>
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

<script src="{{asset('js/WebFrontend/jquery.js')}}"></script>
<script src="{{asset('js/WebFrontend/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/WebFrontend/slick.js')}}"></script>
<script src="{{asset('js/WebFrontend/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    function validateform()
    {
        var name = document.myform.name.value;
        var password = document.myform.password.value;

        if (name == null || name == "") {
            alert("Name can't be blank");
            return false;
        } else if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.email.value)) {
            return (true)
        } else {
            alert("You have entered an invalid email address!")
            return false;
        }
    }
</script>
@yield('customJavascript')
</body>
</html>

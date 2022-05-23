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

{{--@include((\Auth::check())?'WebFrontend.layout.afterLoginNav':'WebFrontend.layout.previousLoginNav')--}}
    <!-- <section class="course-header">
        <div class="container">
            <p class="courses-title">{{$page_name}}</p>
        </div>
    </section> -->
    <section class="banner-wrp inner-banner">
        <img src="{{asset('css/images/dot-group-top.png')}}" class="img-fluid top_icon" alt="#">
        <div class="ban-content">
            <h1 class="cont-head">
                Over <span>About Us</span> dolores
                eos qui ratione volupta temdolored eod...
            </h1>
            <p class="cont-para">
                Iste Natus Error sit Voluptatem Accusantium....
            </p>
            <div class="but-wrap">
                <img src="{{asset('css/images/dot-group.png')}}" class="img-fluid bottom_icon" alt="#">
            </div>
        </div>
    </section>

    <section class="crs-dtls-wrp inner-content-modi"">
        <div class="container">
		<div class="contents textalign_justify">
                <div class="innerinfo">
                    <div class="innerinfo_left">
                    {!!@$content!!}
		    </div>
           
                </div>
           



                <div class="title-part">
                    <span>Our Mission</span>
                    <span class="bar"></span>
                </div>
                {!!@$our_mission!!}

                <div class="title-part">
                    <span>Our vision</span>
                    <span class="bar"></span>
                </div>
                {!!@$our_vision!!}
            </div>
        </div>
    </section>

@endsection

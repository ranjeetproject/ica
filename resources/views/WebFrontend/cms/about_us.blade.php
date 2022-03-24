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
    <section class="course-header">
        <div class="container">
            <p class="courses-title">{{$page_name}}</p>
        </div>
    </section>

    <section class="crs-dtls-wrp">
        <div class="container">

            <div class="contents textalign_justify">
                 {!!@$content!!}
                

            </div>
        </div>
    </section>

@endsection

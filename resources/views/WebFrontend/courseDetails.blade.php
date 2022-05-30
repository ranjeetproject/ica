@extends('WebFrontend.layout.afterLoginApp')
@section('content')
<section class="header">
    <div class="header-top">
        @include('WebFrontend.layout.afterLoginHeaderTop')
    </div>
    <div class="header-bottom">
        @include('WebFrontend.layout.afterLoginNav')
    </div>

</section>
<!-- end header -->
<section class="banner-wrp inner-banner" style="background: url('https://demos.mydevfactory.com/android/public/cms_images/5af933a1227e4e6f1194f5927e0680c1.jpg') no-repeat top right;
">


    <img src="{{asset('css/images/dot-group-top.png')}}" class="img-fluid top_icon" alt="#">
    <div class="ban-content">
        <h1 class="cont-head">
            Over <span>Course details</span> dolores
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


<section class="course-header brdColor">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Course</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $course->course_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="javascript:void(0)">Introduction</a>
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="crs-dtls-wrp">
    <div class="container">
        <!--
<div class="video-wrp">
    <img src="{{ asset('css/images/video-banner.png') }}" alt="#" class="img-fluid" />
    <button class="btn btnplay">
        <img src="{{ asset('css/images/play-icon.svg') }}" class="img-fluid" />
    </button>
</div>
-->

        <div class="contents textalign_justify">
            {{-- <p class="sub-para">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                    porro quisquam est, qui dolorem ipsum
                    quia dolor sit amet, Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                    laboriosam, nisi ut
                    aliquid ex ea commodi consequatur....</p>
                <p class="">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                    porro quisquam est, qui dolorem ipsum
                    quia dolor sit amet, Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                    laboriosam, nisi ut
                    aliquid ex ea commodi consequatur....</p> --}}
            <div class="title-part">
                <span>About Courses</span>
                <span class="bar"></span>
            </div>
            {!! $course->course_details !!}
            <div class="title-part">
                <span>Modules</span>
                <span class="bar"></span>

                <!-- <div class="rating-star">
                    <img src="{{ asset('css/images/full-star.svg') }}" class="img-fluid" />
                    <img src="{{ asset('css/images/full-star.svg') }}" class="img-fluid" />
                    <img src="{{ asset('css/images/full-star.svg') }}" class="img-fluid" />
                    <img src="{{ asset('css/images/full-star.svg') }}" class="img-fluid" />
                    <img src="{{ asset('css/images/outline-star.svg') }}" class="img-fluid" />
                    <span>-4.33(3)</span>
                </div> -->
            </div>
            @foreach ($course->courseChapter as $key => $chapter)
            <div class="module-content">
                <span class="count-number">{{ $key + 1 }}</span>

                <p>{{ $chapter->chapter_name }}<span class="chapProgress"><span>{{round($chapter->read_count_percentage,0)}}%</span> Progress</span></p>
                
                @if($chapter->displayOrNot==1)
                    <a class="lesson-prt" href="{{route('chapter-details',[$chapter->course_id,$chapter->id])}}">
                        <img src="{{ asset('css/images/lesson-icon.png') }}" class="img-fluid" />
                        @if($chapter->topicsCount>1)
                        <span class="lesson-number">{{ $chapter->topicsCount }} Lessons</span>
                        @else
                        <span class="lesson-number">{{ $chapter->topicsCount }} Lesson</span>
                        @endif
                    </a>
                @else
                    <a class="lesson-prt" href="javascript:void(0);" onclick="infoMessage();">
                        <img src="{{ asset('css/images/lesson-icon.png') }}" class="img-fluid" />
                        @if($chapter->topicsCount>1)
                        <span class="lesson-number">{{ $chapter->topicsCount }} Lessons</span>
                        @else
                        <span class="lesson-number">{{ $chapter->topicsCount }} Lesson</span>
                        @endif
                    </a>
                @endif    
            </div>
            @endforeach
          
    </div>
    </div>
</section>
@endsection

@section('customJavascript')
<script>
    function infoMessage()
    {
        Swal.fire(
            'oops!',
            'Plese complete previous lession first, after that you can able to display this chapter.',
            'info'
        )
    }
</script>

@endsection

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

<section class="crs-dtls-wrp">
    <div class="container">
        <div class="profileHdn">
            <h2>Chapter Wise Progress</h2>
        </div>
        <div class="profileBg">
            
            {{-- <div class="profileHdn profsubhdn">
                <h2>Basic</h2>
            </div> --}}
            
            <div class="courseDetlMain">
                
                @if(count($courses)>0)
                <div class="detlTable">
                    <h3>Courses</h3>
                    <ul>
                        @foreach ($courses as $course)
                        <li><span><i class="far fa-angle-double-right"></i></span> <a href="{{ url('chapter-wise-progress-chart', $course->course) }}">{{$course->course_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>

        



    </div>
</section>
<style>
    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

</style>
@endsection
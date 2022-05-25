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
  
    <section class="exam-list-wr">
        <div class="container">
            <h3 class="e-title">
                {{$data->exam_name}}
                <span class="blue-bar"></span>
            </h3>
            <div class="inner_content_info">
                <h4 class="innettitle">
                    MUST KNOW
                </h4>
                <div class="inner_content_view">
                    <div class="inner_block mustKnowbg">
                        {!!$data->exam_for_web!!}

                    </div>
                    <div class="def_btn_opt">
                        <a href="{{url('exam-question',$id)}}" class="def_btn">Start Exam</a>

                    </div>
                     
                </div>

            </div>
        </div>
    </section>
@endsection
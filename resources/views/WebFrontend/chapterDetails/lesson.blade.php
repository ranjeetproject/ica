@extends('WebFrontend.layout.afterLoginApp')
@section('content')
<section class="header">
    <div class="header-top">
        @include('WebFrontend.layout.afterLoginHeaderTop')
    </div>
    <div class="header-bottom">
        @include('WebFrontend.layout.afterLoginNav')
    </div>

    <section class="crs-dtls-wrp">
        <div class="container">
            
           
            @foreach($chapterDetails as $capterValue)                
                <div class="exBg">                
                    <div class="exTop">
                        <h3>
                            <span></span>&nbsp;
                             {{$capterValue->details_titel}}
                            &nbsp;<span></span>
                        </h3>
                        <p>{!! @$capterValue->details_text !!}</p>

                        @if($capterValue->details_video != '')
                            <div class="exvid">
                                <video width="" height="" controls>
                                    <source src="{{$capterValue->details_video}}" type="video/{{$capterValue->extention}}">
                                </video>
                            </div>
                            <br>
                        @endif

                        
                        @if($capterValue->details_img!=null)
                          @if($capterValue->extention==='pdf')
                            <embed src="{{$capterValue->details_img}}" type="application/pdf" frameBorder="0" scrolling="auto" width="100%" />
                          @else
                            <img src="{{$capterValue->details_img}}" alt="" />
                          @endif                         
                        @endif

                        @if($capterValue->exam_id>0)
                            <button class="exsubmit" onclick="location.href = '{{ action('WebFrontend\ExamController@assignmentExamQuestion', ['courseId' => $courseId,'chapterId'=>$chapterId]) }}';">GO FOR ASSESSMENT</button> 
                            <br>
                        @endif
                        
                    </div>
                    <div class="exBtn">
                        <button type="button" onclick="location.href = '{{$previousPageUrl}}';">Previous</button>
                        <button type="button" onclick="location.href = '{{$nextPageUrl}}';">Next</button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</section>


@endsection
@section('customJavascript')

@endsection
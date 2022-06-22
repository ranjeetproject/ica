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
        <div class="innertitle ">
            <h3 class="e-title">
                <span class="blue-bar addbar"></span>
                Your Achievement
                <span class="blue-bar"></span>
            </h3>
        </div>
        <div class="rank_pic_view">
            @if($rank == 1)
                <img src="{{ asset('css/images/rankpic1.png')}}" alt="">
            @elseif($rank == 2)
                <img src="{{ asset('css/images/rankpic2.jpg')}}" alt="">
            @elseif($rank == 3)
                <img src="{{ asset('css/images/rankpic3.jpg')}}" alt="">
            @else
                <img src="{{ asset('css/images/rankpic4.png')}}" alt="">
            @endif
        </div>
        <div class="inner_content_info">
       
            <div class="inner_content_view">
                <div class="inner_block">
                    <div class="result_info ">
                        <div class="result_info_heading ">
                            <span>Exam Name:</span>
                            <span>{{$exam_name}}</span>
                        </div>
                        <div class="result_des">
                            <span>No of Question :</span>
                            <span>{{$questionLimit}}</span>
                        </div>
                        <div class="result_des">
                            <span>Time :</span>
                            <span>{{date('H:i', mktime(0,$time_taken))}}</span>
                        </div>
                        <div class="result_des">
                            <span>Total Marks :</span>
                            <span>{{$full_marks}}</span>
                        </div>
                        <div class="result_des">
                            <span>Your Marks :</span>
                            <span>{{$obtain_marks}}</span>
                        </div>
                        <div class="result_des">
                            <span>Percentage of Marks :</span>
                            <span>{{$marks_percent}} %</span>
                        </div>
                        <div class="result_des">
                            <span>Rank :</span>
                            <span>{{$rank}}</span>
                        </div>
                        <div class="result_des">
                            <span>Status :</span>
                            <span>{{$status}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

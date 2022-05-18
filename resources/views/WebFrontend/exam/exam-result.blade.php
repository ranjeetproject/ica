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
                Your Result
                <span class="blue-bar"></span>
            </h3>
        </div>
        <div class="inner_content_info">
            <div class="inner_content_view">
                <div class="inner_block">
                    <div class="result_info ">
                        <div class="result_info_heading ">
                            <span>Exam Name:</span>
                            <span>{{$studentExam->exam->exam_name}}</span>
                        </div>
                        <div class="result_des">
                            <span>No of Question :</span>
                            <span>{{$studentExam->exam->question_limit}}</span>
                        </div>
                        <div class="result_des">
                            <span>Time :</span>
                            <span>{{$studentExam->total_duration}}</span>
                        </div>
                        <div class="result_des">
                            <span>Total Marks :</span>
                            <span>{{$studentExam->full_marks}}</span>
                        </div>
                        <div class="result_des">
                            <span>Your Marks :</span>
                            <span>{{$studentExam->obtain_marks}}</span>
                        </div>
                        <div class="result_des">
                            <span>Percentage of Marks :</span>
                            <span>{{$studentExam->markPercentage}} %</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="inner_content_info addmargintop ansdetails">
            <div class="inner_content_view">
                <div class="inner_block">
                    <div class="innerlist-item">
                        <span class="countopt">1</span>
                        <div class="item_details">
                            <p class="awsopt">What is Lorem Ipsum?</p>

                        </div>
                    </div>
                    <div class="awsoptview">
                        <div class="viewans definfo">
                            <div class="headingopt">Correct Answer</div>
                            <div class="ansinfo">True</div>
                        </div>
                        <div class="viewans yourans ">
                            <div class="headingopt">Your Answer</div>
                            <div class="ansinfo">True</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="inner_content_info addmargintop ansdetails">
            <div class="inner_content_view">
                <div class="inner_block">
                    <div class="innerlist-item">
                        <span class="countopt">1</span>
                        <div class="item_details">
                            <p class="awsopt">What is Lorem Ipsum?</p>

                        </div>
                    </div>
                    <div class="awsoptview">
                        <div class="viewans definfo">
                            <div class="headingopt">Correct Answer</div>
                            <div class="ansinfo">False text will be here</div>
                        </div>
                        <div class="viewans wrongans">
                            <div class="headingopt">Your Answer</div>
                            <div class="ansinfo">
                                <p>False text will be here : <span>False text will be here</span></p>
                                <p>False text will be here : <span>False text will be here</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--
<div class="def_btn_opt progress_opt">
    <a href="#" class="def_btn">View Progress</a>
</div>
-->


    </div>
</section>
@endsection

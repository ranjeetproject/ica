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
        <div>
            @if($studentExam['rank'] == 1)
                <img src="{{ asset('css/images/rankpic1.png')}}" alt="">
            @elseif($studentExam['rank'] == 2)
                <img src="{{ asset('css/images/rankpic2.jpg')}}" alt="">
            @elseif($studentExam['rank'] == 3)
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
                            <span>{{$studentExam->exam->exam_name}}</span>
                        </div>
                        <div class="result_des">
                            <span>No of Question :</span>
                            <span>{{$questionLimit}}</span>
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
                        @if($studentExam->exam->exam_for == 2)
                            <div class="result_des">
                                <span>Rank :</span>
                                <span>{{$studentExam->rank}}</span>
                            </div>
                            <div class="result_des">
                                <span>Status :</span>
                                <span>{{$studentExam->status}}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        @foreach($correctWrongAnswer as $particularQuestion)
            <div class="inner_content_info addmargintop ansdetails">
                <div class="inner_content_view">
                    <div class="inner_block">
                        <div class="innerlist-item">
                            <span class="countopt">{{ $loop->iteration }}</span>
                            <div class="item_details">
                                @if($particularQuestion->ques_type=='radio' || $particularQuestion->ques_type=='check' 
                                    || $particularQuestion->ques_type=='accounting1' || $particularQuestion->ques_type=='accounting4' || $particularQuestion->ques_type=='accounting6')
                                    <p class="awsopt">{{@$particularQuestion->qustionText}}</p>
                                @elseif($particularQuestion->ques_type=='accounting3')
                                    <p class="awsopt"><img src="{{@$particularQuestion->qus_image}}"></p>
                                @elseif($particularQuestion->ques_type=='accounting5')
                                    <p class="awsopt">Select appropriate option from dropdown list</p>
                                @endIf
                            </div>
                        </div>

                        @if($particularQuestion->ques_type=='radio')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>
                                    <div class="ansinfo">{{@$particularQuestion->qustionOption[$particularQuestion->ques_old_answer-1]}}</div>
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>
                                    <div class="ansinfo">{{@$particularQuestion->qustionOption[$particularQuestion->ques_answer-1]}}</div>
                                </div>
                            </div>
                        @elseif($particularQuestion->ques_type=='check')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>
                                    @foreach($particularQuestion->questionOldAnswer as $checkOptionValue)
                                        <div class="ansinfo">{{@$particularQuestion->qustionOption[$checkOptionValue-1]}}</div>
                                    @endforeach
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>
                                    @foreach($particularQuestion->questionYourAnswer as $checkOptionValue)
                                        <div class="ansinfo">{{@$particularQuestion->qustionOption[$checkOptionValue-1]}}</div>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($particularQuestion->ques_type=='accounting1')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>
                                    <div class="ansinfo"> Assets : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[0]-1]}}</div>
                                    <div class="ansinfo">Liabilities : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[1]-1]}}</div>
                                    <div class="ansinfo">Equity : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[2]-1]}}</div>                                    
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>
                                    <div class="ansinfo"> Assets : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[0]-1]}}</div>
                                    <div class="ansinfo">Liabilities : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[1]-1]}}</div>
                                    <div class="ansinfo">Equity : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[2]-1]}}</div>                                    
                                </div>
                            </div>  
                        @elseif($particularQuestion->ques_type=='accounting2')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>
                                    @foreach($particularQuestion->questionOldAnswer as $oldAnswer)
                                        <div class="ansinfo"> Primary Account : 
                                                @foreach($particularQuestion->primaryAccount as $primary)
                                                    @if(@$oldAnswer[0]==$primary->id)
                                                        {{$primary->account_name}}
                                                    @endif
                                                @endforeach
                                            <br>
                                            Secondary Account :
                                                @foreach($particularQuestion->secondaryAccount as $secondary)
                                                    @if(@$oldAnswer[1]==$secondary->id)
                                                        {{$secondary->acc_name}}
                                                    @endif
                                                @endforeach
                                            <br>
                                            Bank Account : 
                                                @foreach($particularQuestion->account as $account)
                                                    @if(@$oldAnswer[2]==$account->id)
                                                        {{$account->accName}}
                                                    @endif
                                                @endforeach
                                            <br>
                                            {{@$oldAnswer[3]}} @if(@$oldAnswer[4]==1) DR @else CR @endif
                                        </div>
                                    @endforeach                                                                        
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>
                                    @foreach($particularQuestion->questionYourAnswer as $yourAnswer)
                                        <div class="ansinfo"> Primary Account : 
                                                @foreach($particularQuestion->primaryAccount as $primary)
                                                    @if(@$yourAnswer[0]==$primary->id)
                                                        {{$primary->account_name}}
                                                    @endif
                                                @endforeach
                                            <br>
                                            Secondary Account :
                                                @foreach($particularQuestion->secondaryAccount as $secondary)
                                                    @if(@$yourAnswer[1]==$secondary->id)
                                                        {{$secondary->acc_name}}
                                                    @endif
                                                @endforeach
                                            <br>
                                            Bank Account : 
                                                @foreach($particularQuestion->account as $account)
                                                    @if(@$yourAnswer[2]==$account->id)
                                                        {{$account->accName}}
                                                    @endif
                                                @endforeach
                                            <br>
                                            {{@$yourAnswer[3]}} @if(@$yourAnswer[4]==1) DR @else CR @endif
                                        </div>
                                    @endforeach
                                                                        
                                </div>
                            </div>
                        @elseif($particularQuestion->ques_type=='accounting3')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>                                    
                                        <div class="ansinfo">{{@$particularQuestion->qustionOption[$particularQuestion->ques_old_answer-1]}}</div>                                    
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>                                    
                                    <div class="ansinfo">{{@$particularQuestion->qustionOption[$particularQuestion->ques_answer-1]}}</div>
                                </div>
                            </div> 
                        @elseif($particularQuestion->ques_type=='accounting4')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>
                                    <div class="ansinfo"> Assets : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[0]-1]}}
                                        <br>
                                        @foreach($particularQuestion->reasonEquity as $reason)
                                            @if($particularQuestion->questionOldAnswer[1][0]==$reason->id)
                                                {{$reason->reason_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        {{$particularQuestion->questionOldAnswer[1][1]}}
                                    </div>
                                    <div class="ansinfo">Liabilities : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[2]-1]}}
                                        <br>
                                        @foreach($particularQuestion->reasonEquity as $reason)                                            
                                            @if(@$particularQuestion->questionOldAnswer[3][0]==$reason->id)
                                                {{$reason->reason_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        @foreach($particularQuestion->secondaryAccount as $secondary)
                                            @if(@$particularQuestion->questionOldAnswer[3][1]==$secondary->id)
                                                {{$secondary->acc_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        {{@$particularQuestion->questionOldAnswer[3][2]}}   
                                    </div>
                                    <div class="ansinfo">Equity : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[4]-1]}}
                                        <br>
                                        @foreach($particularQuestion->reasonEquity as $reason)
                                            @if(@$particularQuestion->questionOldAnswer[5][0]==$reason->id)
                                                {{$reason->reason_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        @foreach($particularQuestion->secondaryAccount as $secondary)
                                            @if(@$particularQuestion->questionOldAnswer[5][1]==$secondary->id)
                                                {{$secondary->acc_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        {{@$particularQuestion->questionOldAnswer[5][2]}} 
                                    </div>                                     
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>
                                    <div class="ansinfo"> Assets : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[0]-1]}}
                                        <br>
                                        @foreach($particularQuestion->reasonEquity as $reason)
                                            @if(@$particularQuestion->questionYourAnswer[1][0]==$reason->id)
                                                {{$reason->reason_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        {{$particularQuestion->questionYourAnswer[1][1]}}
                                    </div>
                                    <div class="ansinfo">Liabilities : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[2]-1]}}  
                                        <br>
                                        @foreach($particularQuestion->reasonEquity as $reason)
                                            @if(@$particularQuestion->questionYourAnswer[3][0]==$reason->id)
                                                {{$reason->reason_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        @foreach($particularQuestion->secondaryAccount as $secondary)
                                            @if(@$particularQuestion->questionYourAnswer[3][1]==$secondary->id)
                                                {{$secondary->acc_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        {{@$particularQuestion->questionYourAnswer[3][2]}}                                      
                                    </div>
                                    <div class="ansinfo">Equity : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[4]-1]}}
                                        <br>
                                        @foreach($particularQuestion->reasonEquity as $reason)
                                            @if(@$particularQuestion->questionYourAnswer[5][0]==$reason->id)
                                                {{$reason->reason_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        @foreach($particularQuestion->secondaryAccount as $secondary)
                                            @if(@$particularQuestion->questionYourAnswer[5][1]==$secondary->id)
                                                {{$secondary->acc_name}}
                                            @endif
                                        @endforeach
                                        <br>
                                        {{@$particularQuestion->questionYourAnswer[5][2]}}     
                                    
                                    </div>                                    
                                </div>
                            </div>     
                        @elseif($particularQuestion->ques_type=='accounting5')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>
                                    @foreach($particularQuestion->qustionTextArray as $questionKey=>$questionValue)
                                        <div class="ansinfo">{{$questionValue}} : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[$questionKey]-1]}}</div>
                                    @endforeach
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>
                                    @foreach($particularQuestion->qustionTextArray as $questionKeyYourAns=>$questionValue)
                                        <div class="ansinfo">{{$questionValue}} : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[$questionKeyYourAns]-1]}}</div>
                                    @endforeach
                                </div>
                            </div>        
                        @elseif($particularQuestion->ques_type=='accounting6')
                            <div class="awsoptview">
                                <div class="viewans definfo">
                                    <div class="headingopt">Correct Answer</div>
                                    <div class="ansinfo"> Assets : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[0]-1]}}</div>
                                    <div class="ansinfo">Liabilities : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[1]-1]}}</div>
                                    <div class="ansinfo">Income : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[2]-1]}}</div>
                                    <div class="ansinfo">Expenses : {{@$particularQuestion->qustionOption[$particularQuestion->questionOldAnswer[3]-1]}}</div>                                      
                                </div>
                                <div class="viewans @if($particularQuestion->ques_old_answer==$particularQuestion->ques_answer) yourans @else wrongans @endif">
                                    <div class="headingopt">Your Answer</div>
                                    <div class="ansinfo"> Assets : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[0]-1]}}</div>
                                    <div class="ansinfo">Liabilities : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[1]-1]}}</div>
                                    <div class="ansinfo">Income : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[2]-1]}}</div> 
                                    <div class="ansinfo">Expenses : {{@$particularQuestion->qustionOption[$particularQuestion->questionYourAnswer[3]-1]}}</div>                                    
                                </div>
                            </div>
                        @endIf
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="inner_content_info addmargintop ansdetails">
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
        </div> --}}


        <!--
<div class="def_btn_opt progress_opt">
    <a href="#" class="def_btn">View Progress</a>
</div>
-->


    </div>
</section>
@endsection

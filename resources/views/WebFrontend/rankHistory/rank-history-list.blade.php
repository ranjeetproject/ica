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
                Rank History
                <span class="blue-bar"></span>
            </h3>
            <div class="inner_cont_wap">
                @foreach ($res_array as $rank)
                    <a href="{{action('WebFrontend\RankHistoryController@examResult',['id'=>$rank['id'],'exam_name'=>$rank['exam_name'],'exam_for'=>$rank['exam_for'],'full_marks'=>$rank['full_marks'],'obtain_marks'=>$rank['obtain_marks'],'marks_percent'=>$rank['marks_percent'],'rank'=>$rank['rank'],'time_taken'=>$rank['time_taken'],'status'=>$rank['status']])}}">
                        <div class="list-item certified_opt rankhistory">
                            <div class="item_details">
                                <div class="history_info">
                                    <p class="titleopt">{{$rank['exam_name']}} </p>
                                    <div class="rankdetails">
                                        <p class="rankopt">Rank : {{$rank['rank']}}</p>
                                        <p>Marks (%) : {{$rank['marks_percent']}}</p>
                                        <p>Time Taken: {{date('H:i:s', mktime(0,$rank['time_taken']))}}</p>
                                        <p>Date: {{$rank['date_time']}}</p>
                                    </div>
                                
                                </div>
                                <div class="rankpic leargimg">
                                    @if($rank['rank'] == 1)
                                        <img src="{{ asset('css/images/rankpic1.png')}}" alt="">
                                    @elseif($rank['rank'] == 2)
                                        <img src="{{ asset('css/images/rankpic2.jpg')}}" alt="">
                                    @elseif($rank['rank'] == 3)
                                        <img src="{{ asset('css/images/rankpic3.jpg')}}" alt="">
                                    @else
                                        <img src="{{ asset('css/images/rankpic4.png')}}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
          
          
        </div>
    </section> 
@endsection
@section('customJavascript')
@endsection
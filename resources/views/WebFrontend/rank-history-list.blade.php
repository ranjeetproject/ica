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
                <div class="list-item certified_opt rankhistory">
                    <div class="item_details">
                        <div class="history_info">
                            <p class="titleopt">{{$rank['exam_name']}} </p>
                            <div class="rankdetails">
                                <p class="rankopt">Rank : {{$rank['rank']}}</p>
                                <p>Marks (%) : {{$rank['marks_percent']}}</p>
                                <p>Time Taken: {{date('H:i', mktime(0,$rank['time_taken']))}}</p>
                                <p>Date: {{$rank['date_time']}}</p>
                            </div>
                           
                        </div>
                        <div class="rankpic leargimg">
                        @if($rank['rank'] == 1)
                            <img src="{{ asset('css/images/rankpic1.png')}}" alt="">
                        @else
                            <img src="{{ asset('css/images/rankpic4.png')}}" alt="">
                        @endif
                        </div>
                    </div>
                </div>
            @endforeach
                
                {{-- <div class="list-item certified_opt rankhistory">
                    <div class="item_details">
                        <div class="history_info">
                            <p class="titleopt">Tally world Chemp (w2042022) </p>
                            <div class="rankdetails">
                                <p class="rankopt">Rank : 543</p>
                                <p>Marks (%) : 27</p>
                                <p>Time Taken: 0.39 Min</p>
                                <p>Date: 07/03/2022</p>
                            </div>
                           
                        </div>
                        <div class="rankpic leargimg">
                            <img src="{{asset('css/images/rankpic4.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="list-item certified_opt rankhistory">
                    <div class="item_details">
                        <div class="history_info">
                            <p class="titleopt">Tally world Chemp (w2042022) </p>
                            <div class="rankdetails">
                                <p class="rankopt">Rank : 543</p>
                                <p>Marks (%) : 27</p>
                                <p>Time Taken: 0.39 Min</p>
                                <p>Date: 07/03/2022</p>
                            </div>
                           
                        </div>
                        <div class="rankpic leargimg">
                            <img src="{{asset('css/images/rankpic4.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="list-item certified_opt rankhistory">
                    <div class="item_details">
                        <div class="history_info">
                            <p class="titleopt">Tally world Chemp (w2042022) </p>
                            <div class="rankdetails">
                                <p class="rankopt">Rank : 543</p>
                                <p>Marks (%) : 27</p>
                                <p>Time Taken: 0.39 Min</p>
                                <p>Date: 07/03/2022</p>
                            </div>
                           
                        </div>
                        <div class="rankpic">
                            <img src="{{asset('css/images/rankpic4.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="list-item certified_opt rankhistory">
                    <div class="item_details">
                        <div class="history_info">
                            <p class="titleopt">Tally world Chemp (w2042022) </p>
                            <div class="rankdetails">
                                <p class="rankopt">Rank : 543</p>
                                <p>Marks (%) : 27</p>
                                <p>Time Taken: 0.39 Min</p>
                                <p>Date: 07/03/2022</p>
                            </div>
                           
                        </div>
                        <div class="rankpic leargimg">
                            <img src="{{asset('css/images/rankpic4.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="list-item certified_opt rankhistory">
                    <div class="item_details">
                        <div class="history_info">
                            <p class="titleopt">Tally world Chemp (w2042022) </p>
                            <div class="rankdetails">
                                <p class="rankopt">Rank : 543</p>
                                <p>Marks (%) : 27</p>
                                <p>Time Taken: 0.39 Min</p>
                                <p>Date: 07/03/2022</p>
                            </div>
                           
                        </div>
                        <div class="rankpic leargimg">
                            <img src="{{asset('css/images/rankpic4.png')}}" alt="">
                        </div>
                    </div>
                </div> --}}
            </div>
          
          
        </div>
    </section> 
@endsection
@section('customJavascript')
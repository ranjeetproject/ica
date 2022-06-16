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
        <div class="container" id="exam-data">
            <h3 class="e-title">
                Academic Details
                <span class="blue-bar"></span>
            </h3>
            <div class="inner_cont_wap">
                <!-- Tab content -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#mobulestatus">Module Status</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#marksinfo">Marks</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#attendanceinfo">Attendance</a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane  active" id="mobulestatus">
                        <div class="mobule_opt">
                            <div class="mobuledef_opt">
                                <div class="pending_opt"></div> Pending
                            </div>
                            <div class="mobuledef_opt">
                                <div class="running_opt"></div> Running
                            </div>
                            <div class="mobuledef_opt">
                                <div class="completed_opt"></div> Completed
                            </div>
                        </div>
                        <div class="listcont_view">
                            @foreach($moduleStatus as $value)
                                <div class="list-item certified_opt rankhistory">
                                    <div class="item_details">
                                        <div class="history_info">
                                            <p>{{$value['Subject_name']}} </p>
                                        </div>
                                        <div class="rankpic">
                                            @if($value['flag']=='R')
                                                <div class="pending_opt"></div>
                                            @elseif($value['flag']=='Y')   
                                                <div class="completed_opt"></div>
                                            @elseif($value['flag']=='G') 
                                                <div class="running_opt"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="marksinfo">

                        <div class="listcont_view">
                            @foreach($subjectDetailsResponse as $value)
                                <div class="list-item certified_opt rankhistory">
                                    <div class="item_details">
                                        <div class="history_info">
                                            <p class="titleopt">{{$value['SUBJECT_GROUP_NAME']}}</p>
                                            @if($value['SUBJECT_STATUS']=='P')
                                                <p class="moduleinfo_text">Module Status: Module Pending</p>
                                            @elseif($value['SUBJECT_STATUS']=='C')   
                                                <p class="moduleinfo_text">Module Status: Exam Passed</p>
                                                <p class="moduleinfo_text">Marks (%): {{$value['MARKSPERCENT']}}</p>
                                            @elseif($value['SUBJECT_STATUS']=='F')   
                                                <p class="moduleinfo_text">Module Status: Exam Failed</p>
                                                <p class="moduleinfo_text">Marks (%): {{$value['MARKSPERCENT']}}</p>
                                            @elseif($value['SUBJECT_STATUS']=='E')   
                                                <p class="moduleinfo_text">Module Status: Exam Running</p>                                                    
                                            @endif
                                        </div>
                                    
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="attendanceinfo">
                        <div class="listcont_view">
                            @foreach($subjectDetailsResponse as $value)
                                <div class="list-item certified_opt rankhistory">
                                    <div class="item_details">
                                        <div class="history_info">
                                            <p class="titleopt">{{$value['SUBJECT_GROUP_NAME']}}</p>
                                            <p class="moduleinfo_text">Start Date: {{date('d/m/Y',strtotime($value['COURSESTARTDATE']))}} </p>
                                            <p class="moduleinfo_text">End Date: {{date('d/m/Y',strtotime($value['COURSEENDDATE']))}}</p>
                                            <p class="moduleinfo_text">Attendance(%): {{$value['ATTENPERCENT']}} </p>
                                        </div>                                    
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
               <!-- Tab content end -->
            </div>
        </div>
        <div class="col-md-12">
                <div class="load-more" style="display:none">
                    <img src="{{ asset('css/images/loadmore-icon.png') }}" class="img-fluid" />
                    <p>Load more...</p>
                </div>
            </div>
    </section>
@endsection
@section('customJavascript')
@endsection

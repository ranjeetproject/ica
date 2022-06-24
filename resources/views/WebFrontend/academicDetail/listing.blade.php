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
            @if (isset($apiData['courses']))
            
                @foreach($apiData['courses'] as $value)
                    <a href="{{action('WebFrontend\CourseController@particulerAcademicDetailFetch',['id'=>@$value['courseid']])}}">
                        <div class="list-item certified_opt">
                            <div class="item_details">
                                <p class="titleopt">{{@$value['coursename']}} </p>
                                <p class="date_opt">Admission Date : {{@$value['admission']}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
            
                <p class="noDt">No Data Available</p>
        
            @endif

                
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

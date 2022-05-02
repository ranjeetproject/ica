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
                Competitive Exam list
                <span class="blue-bar"></span>
            </h3>
            
             @foreach ($comExam as $key=>$exam)
                <div class="list-item">
                    <span>{{$key+1}}</span>
                    <a class="nav-link" href="#">
                        <p>{{$exam->exam_name}}</p>
                    </a>
                </div>
             @endforeach
            
            <nav aria-label="...">
                {{$comExam->links('WebFrontend.custom-competitive-exam-pagination')}} 
            </nav>
        </div>
    </section>
@endsection
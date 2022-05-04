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
                    <div class="inner_block">
                        <h5 class="innettitle2">
                            Guidelines :
                        </h5>
                        <div class="innerlist-item">
                            <span class="countopt" >1</span>
                            <div class="item_details">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.</div>
                        </div>
                        <div class="innerlist-item">
                            <span class="countopt">2</span>
                            <div class="item_details">Magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.</div>
                        </div>
                        <div class="innerlist-item">
                            <span class="countopt">3</span>
                            <div class="item_details">Guntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.luptatem sequi nesciunt. Guntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.luptatem sequi nesciunt.Guntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.luptatem sequi nesciunt. </div>
                        </div>
                        <div class="innerlist-item">
                            <span class="countopt">4</span>
                            <div class="item_details">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.</div>
                        </div>
                        <div class="innerlist-item">
                            <span class="countopt">5</span>
                            <div class="item_details">Dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam. </div>
                        </div>
                    </div>
                    <div class="inner_block">
                        <h5 class="innettitle2">
                            Ctiteria :
                        </h5>
                        <div class="innerlist-item">
                            <span class="countopt" >1</span>
                            <div class="item_details">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.</div>
                        </div>
                        <div class="innerlist-item">
                            <span class="countopt">2</span>
                            <div class="item_details">Magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.</div>
                        </div>
                    </div>

                    <div class="def_btn_opt">
                        <a href="{{url('exam-question',$id)}}" class="def_btn">Start Exam</a>

                    </div>
                     
                    {!! $data->exam_details!!}
                </div>

            </div>
        </div>
    </section>
@endsection
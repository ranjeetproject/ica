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
            <div class="innertitle modf_heading">
                <h3 class="e-title">
                    <span class="blue-bar addbar"></span>
                    {{$data->exam_name}}
                    <span class="blue-bar"></span>
                </h3>
                <div class="dateoption">
                    <div class="dateinfo"><span>Date : </span><strong>{{date('d-m-Y')}}</strong></div>
                    <div class="timeinfo"><span class="clockimg"><img src="images/clockimg.png" alt="">
                    </span> <strong> 01:15:35 </strong><span> Remaining</span></div>
                </div>
            </div>
            
            <div class="inner_content_info">
               
                @include('WebFrontend.custom-exam-start-pagination')

            </div>
        </div>
    </section>



@endsection
@section('customJavascript')
    <script>
    $(document).ready(function(){
        $(document).on('click', '.nextbtn', function(event){
            event.preventDefault(); 
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page)
        {
            var id =  $("#exam_id").val();
            $.ajax({
                url:"{{ route('pagination-fetch') }}",
                method:"GET",
                data:{page:page,id:id},
                success:function(data)
                {
                   // console.log(data)
                $('#inner_content_info').html(data);
                }
            });
        }
    });
    </script>
@endsection

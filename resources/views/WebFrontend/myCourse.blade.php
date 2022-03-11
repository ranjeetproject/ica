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
    <!-- end header -->

    <section class="course-header">
        <div class="container">
            <p class="courses-title">Courses</p>
        </div>
    </section>
    <section class="couses-wrap">
        <div class="container">
            <div class="row" id="course-data">
                @include('WebFrontend.all-course')
                
                <div class="col-md-12">
                    <div class="load-more" style="display:none">
                        <img src="{{asset('css/images/loadmore-icon.png')}}" class="img-fluid" />
                        <p>Load more...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJavascript')
    <script>
    function loadMoreData(page){
            $.ajax(
	        {
	            url:'?page=' + page,
	            type: "get",
	            beforeSend: function()
	            {
	                $('.load-more').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data.html == " "){
	                $('.load-more').html("No more records found");
	                return;
	            }
	            $('.load-more').hide();
	            $("#course-data").append(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
    }

    var page = 1;
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() + 50 >= $(document).height()){
            page++;
            loadMoreData(page);
        }
    });


    </script>
@endsection

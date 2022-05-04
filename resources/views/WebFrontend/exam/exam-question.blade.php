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
                    {{ $examName }}
                    <span class="blue-bar"></span>
                </h3>
                <div class="dateoption">
                    <div class="dateinfo"><span>Date : </span><strong> {{ date('d-m-Y') }}</strong></div>
                    <div class="timeinfo"><span class="clockimg"><img src="{{asset('css/images/clockimg.png')}}" alt="">
                        </span> <strong id="countdown">  </strong> <span> Remaining</span></div>
                </div>
            </div>

            <div class="examSlider">
                <!-- Button trigger modal -->
                <button type="button" class="examCount" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span id="exam-count">1</span>/{{$questionLimit}}
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                        class="numberIcn" aria-current="true" aria-label="Slide 1"><span
                                            data-bs-dismiss="modal">1</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 2"><span
                                            data-bs-dismiss="modal">2</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 3"><span
                                            data-bs-dismiss="modal">3</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 4"><span
                                            data-bs-dismiss="modal">4</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 5"><span
                                            data-bs-dismiss="modal">5</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 6"><span
                                            data-bs-dismiss="modal">6</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 7"><span
                                            data-bs-dismiss="modal">7</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 8"><span
                                            data-bs-dismiss="modal">8</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="8"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 9">
                                        <span data-bs-dismiss="modal">9</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="9"
                                        data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 10"><span
                                            data-bs-dismiss="modal">10</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="carouselExampleIndicators" class="carousel" data-bs-interval="false">
                    <div class="carousel-inner" id="questionHolder">
                    </div>
                    <div class="carouselFlow">
                        <button class="carousel-control-prev" type="button"><span class="">Previous</span>
                        </button>
                       {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev"><span class="">Previous</span>
                        </button>
                         <button class="carousel-control-next" type="button" id="skip" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next"><span class="">Skip</span>
                        </button>
                        <button class="carousel-control-next" type="button"  id="next" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next"><span class="">Next</span>
                        </button> --}}
                        <button class="carousel-control-next-skip" id="skip" type="button"><span class="">Skip</span>
                        </button>
                        <button class="carousel-control-next" type="button"><span class="">Next Again</span>
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@section('customJavascript')
    <script>
        var examId = '{{ $id }}';
        let url = "{{ action('WebFrontend\ExamController@examQuestion', ['id' => $id]) }}";
        var buttonType='';

        function fetch_data() {
            $.ajax({
                    url: url,
                    method: "GET",
                    beforeSend: function() {
                        $('.load-more').show();
                    }
                })
                .done(function(response) {
                    $('#questionHolder').html(response.html);
                    updateCountdown();                   

                    var myCarousel = document.getElementById('carouselExampleIndicators');
                    var carousel = bootstrap.Carousel.getInstance(myCarousel);
                    
                    $('.carousel-control-next-skip').click(function() {
                        $('#carouselExampleIndicators').carousel('next');
                        $(".carousel-item").each(function() 
                        {
                            if ($(this).hasClass("active"))
                            {
                                console.log($(this).attr("slide"));
                                $('#exam-count').text($(this).attr("slide"));
                            }
                        });
                        
                    });

                    $(".carousel-control-prev").click(function() {
                        $('#carouselExampleIndicators').carousel('prev');
                        $(".carousel-item").each(function() {
                            if ($(this).hasClass("active")) {
                                $('#exam-count').text($(this).attr("slide"));
                                var questionType = $(this).children(".questionType").val();
                            }
                        });
                        
                    });

                    $('.carousel-control-next').click(function() 
                    {
                        $(".carousel-item").each(function() 
                        {
                            if ($(this).hasClass("active")) 
                            {
                                var questionType = $(this).children(".questionType").val();                               
                            
                                if (questionType === 'radio') 
                                {
                                    var curInputs = $(this).find("input[type='radio']");
                                    var check = true;
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var name = curInputs[i].name;
                                        if($("input:radio[name="+name+"]:checked").length == 0){
                                            check = false;
                                        }
                                    }                                       
                                    
                                    if(!check){
                                        return event.preventDefault();
                                    }
                                    else{
                                        $('#exam-count').text($(this).attr("slide"));
                                        $('#carouselExampleIndicators').carousel('next');
                                    }                                    
                                }
                                if (questionType === 'check') 
                                {                                    
                                    var curInputs = $(this).find("input[type='checkbox']");
                                    var check = false;
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var name = curInputs[i].name;
                                        if (curInputs[i].checked) 
                                        {
                                            check = true;                                            
                                        }
                                    }

                                    if(!check){
                                        return event.preventDefault();
                                    }
                                    else
                                    {
                                        $('#exam-count').text($(this).attr("slide"));                                        
                                        $('#carouselExampleIndicators').carousel('next');
                                    }
                                }
                                if (questionType === 'accounting1') 
                                {
                                    var curInputs = $(this).find("input[type='radio']");
                                    var check = true;
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var name = curInputs[i].name;
                                        if($("input:radio[name="+name+"]:checked").length == 0){
                                            check = false;
                                        }
                                    }                                       
                                    
                                    if(!check){
                                        return event.preventDefault();
                                    }
                                    else{
                                        $('#exam-count').text($(this).attr("slide"));
                                        $('#carouselExampleIndicators').carousel('next');
                                    }

                                }
                                if (questionType === 'accounting2') 
                                {
                                    var curInputs = $(this).find("input[type='number'],input[type='radio'],select");  
                                    var check = true;                                 
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var type = curInputs[i].type;
                                        var name = curInputs[i].name;
                                        var id = curInputs[i].id;
                                        if(type != 'radio')
                                        {
                                            if($('#'+id).val()=='')
                                            {
                                                check = false; 
                                            }  
                                        }
                                        if(type == 'radio')
                                        {
                                            console.log('d');
                                            if($("input:radio[name="+name+"]:checked").length == 0)
                                            {
                                                
                                                check = false;
                                                console.log(i +"  "+ check);
                                            }


                                        }
                                    }

                                    if(!check){
                                        return event.preventDefault();
                                    }
                                    else{
                                        $('#exam-count').text($(this).attr("slide"));
                                        $('#carouselExampleIndicators').carousel('next');
                                    }
                                }
                                if (questionType === 'accounting3')
                                {
                                    var curInputs = $(this).find("select");  
                                    var check = true;                                 
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var name = curInputs[i].name;
                                        var id = curInputs[i].id;
                                        if($('#'+id).val()=='')
                                        {
                                            check = false; 
                                        } 
                                    }

                                    if(!check){
                                        return event.preventDefault();
                                    }
                                    else{
                                        $('#exam-count').text($(this).attr("slide"));
                                        $('#carouselExampleIndicators').carousel('next');
                                    }
                                }
                                if (questionType === 'accounting4') {
                                    
                                }
                                if (questionType === 'accounting5') 
                                {
                                    var curInputs = $(this).find("select");  
                                    var check = true;                                 
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var name = curInputs[i].name;
                                        var id = curInputs[i].id;
                                        if($('#'+id).val()=='')
                                        {
                                            check = false; 
                                        } 
                                    }

                                    if(!check){
                                        return event.preventDefault();
                                    }
                                    else{
                                        $('#exam-count').text($(this).attr("slide"));
                                        $('#carouselExampleIndicators').carousel('next');
                                    }
                                }
                                if (questionType === 'accounting6') 
                                {
                                    var curInputs = $(this).find("input[type='radio']");
                                    var check = true;
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var name = curInputs[i].name;
                                        if($("input:radio[name="+name+"]:checked").length == 0){
                                            check = false;
                                        }
                                    }                                       
                                    
                                    if(!check){
                                        return event.preventDefault();
                                    }
                                    else{
                                        $('#exam-count').text($(this).attr("slide"));
                                        $('#carouselExampleIndicators').carousel('next');
                                    }
                                }
                            }
                        });
                        
                    });

                    
                   
                    // myCarousel.addEventListener('slide.bs.carousel', function(event) 
                    // {   
                    //     $(".carousel-item").each(function() 
                    //     {
                    //         if ($(this).hasClass("active")) 
                    //         {
                    //             $('#exam-count').text($(this).attr("slide"));
                    //             var questionType = $(this).children(".questionType").val();                               
                            
                    //             if (questionType === 'radio') 
                    //             {
                    //                 console.log("Inner :"+buttonType);

                    //                 var curInputs = $(this).find("input[type='radio']");
                    //                 var check = true;
                    //                 for (var i = 0; i < curInputs.length; i++) 
                    //                 {
                    //                     var name = curInputs[i].name;
                    //                     if($("input:radio[name="+name+"]:checked").length == 0){
                    //                         check = false;
                    //                     }
                    //                 }                                       
                                    
                    //                 if(!check){
                    //                     return event.preventDefault();
                    //                 }
                                    
                    //             }
                    //             if (questionType === 'check') {                                    
                    //                 // var curInputs = $(this).find("input[type='checkbox']");
                    //                 // var check = false;
                    //                 // for (var i = 0; i < curInputs.length; i++) 
                    //                 // {
                    //                 //     var name = curInputs[i].name;
                    //                 //     if (curInputs[i].checked) 
                    //                 //     {
                    //                 //         check = true;                                            
                    //                 //     }
                    //                 // }

                    //                 // if(!check){
                    //                 //     return event.preventDefault();
                    //                 // }
                    //             }
                    //             if (questionType === 'accounting1') {
                    //                 // var curInputs = $(this).find("input[type='radio']");
                    //                 // var check = true;
                    //                 // for (var i = 0; i < curInputs.length; i++) 
                    //                 // {
                    //                 //     var name = curInputs[i].name;
                    //                 //     if($("input:radio[name="+name+"]:checked").length == 0){
                    //                 //         check = false;
                    //                 //     }
                    //                 // }                                       
                                    
                    //                 // if(!check){
                    //                 //     return event.preventDefault();
                    //                 // }

                    //             }
                    //             if (questionType === 'accounting2') {
                    //                 //    var curInputs = $(this).find("input[type='number'],input[type='radio'],select");  
                    //                 //    var check = true;                                 
                    //                 //     for (var i = 0; i < curInputs.length; i++) 
                    //                 //     {
                    //                 //         var type = curInputs[i].type;
                    //                 //         var name = curInputs[i].name;
                    //                 //         var id = curInputs[i].id;
                    //                 //         if(type != 'radio')
                    //                 //         {
                    //                 //             if($('#'+id).val()=='')
                    //                 //             {
                    //                 //                 check = false; 
                    //                 //             }  
                    //                 //         }
                    //                 //         if(type == 'radio')
                    //                 //         {
                    //                 //             console.log('d');
                    //                 //             if($("input:radio[name="+name+"]:checked").length == 0)
                    //                 //             {
                                                    
                    //                 //                 check = false;
                    //                 //                 console.log(i +"  "+ check);
                    //                 //             }


                    //                 //         }
                    //                 //     }

                    //                 //     if(!check){
                    //                 //         return event.preventDefault();
                    //                 //     }
                    //             }
                    //             if (questionType === 'accounting3')
                    //             {
                    //                 // var curInputs = $(this).find("select");  
                    //                 // var check = true;                                 
                    //                 // for (var i = 0; i < curInputs.length; i++) 
                    //                 // {
                    //                 //     var name = curInputs[i].name;
                    //                 //     var id = curInputs[i].id;
                    //                 //     if($('#'+id).val()=='')
                    //                 //     {
                    //                 //         check = false; 
                    //                 //     } 
                    //                 // }

                    //                 // if(!check){
                    //                 //     return event.preventDefault();
                    //                 // }

                    //             }
                    //             if (questionType === 'accounting4') {
                                    
                    //             }
                    //             if (questionType === 'accounting5') {
                    //                 // var curInputs = $(this).find("select");  
                    //                 // var check = true;                                 
                    //                 // for (var i = 0; i < curInputs.length; i++) 
                    //                 // {
                    //                 //     var name = curInputs[i].name;
                    //                 //     var id = curInputs[i].id;
                    //                 //     if($('#'+id).val()=='')
                    //                 //     {
                    //                 //         check = false; 
                    //                 //     } 
                    //                 // }

                    //                 // if(!check){
                    //                 //     return event.preventDefault();
                    //                 // }
                    //             }
                    //             if (questionType === 'accounting6') {
                    //                 // var curInputs = $(this).find("input[type='radio']");
                    //                 // var check = true;
                    //                 // for (var i = 0; i < curInputs.length; i++) 
                    //                 // {
                    //                 //     var name = curInputs[i].name;
                    //                 //     if($("input:radio[name="+name+"]:checked").length == 0){
                    //                 //         check = false;
                    //                 //     }
                    //                 // }                                       
                                    
                    //                 // if(!check){
                    //                 //     return event.preventDefault();
                    //                 // }
                    //             }
                    //         }
                    //     });
                                              
                    // });

                    

                    
                })
        }

        $(function() {
            fetch_data();
            $(".numberIcn").click(function() {
                var button = $(this).text();
                $('#exam-count').text(button);
            });
        });

        


        
        const startingMinuites = 10;
        let time = startingMinuites * 60;
        const countdownEl = document.getElementById('countdown')
        const interval =setInterval(updateCountdown,1000);
        function updateCountdown()
        {
            const minute = Math.floor(time/60);
            let second = time % 60
            countdownEl.innerText = `${(minute<10)?'0'+ minute:minute}: ${(second<10)?'0'+ second:second}`
            if(time==0){                
                clearInterval(interval)
            }else{
                time--;
            }

        }
        
    </script>

    
@endsection

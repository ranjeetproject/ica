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
                                <div class="askp">
                                    <div class="answerd">Answered: <span class="ans"></span></div>
                                    <div class="skpped">Skipped: <span class="skp"></span></div>
                                </div>
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                        class="numberIcn" aria-current="true" id="numberIcnButton_1" aria-label="Slide 1"><span
                                            data-bs-dismiss="modal">1</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                        data-bs-dismiss="modal" class="numberIcn" id="numberIcnButton_2" aria-label="Slide 2"><span
                                            data-bs-dismiss="modal">2</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                        data-bs-dismiss="modal" class="numberIcn"  id="numberIcnButton_3" aria-label="Slide 3"><span
                                            data-bs-dismiss="modal">3</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                                        data-bs-dismiss="modal" class="numberIcn"  id="numberIcnButton_4" aria-label="Slide 4"><span
                                            data-bs-dismiss="modal">4</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                                        data-bs-dismiss="modal" class="numberIcn" id="numberIcnButton_5" aria-label="Slide 5"><span
                                            data-bs-dismiss="modal">5</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"
                                        data-bs-dismiss="modal" class="numberIcn" id="numberIcnButton_6" aria-label="Slide 6"><span
                                            data-bs-dismiss="modal">6</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6"
                                        data-bs-dismiss="modal" class="numberIcn" id="numberIcnButton_7" aria-label="Slide 7"><span
                                            data-bs-dismiss="modal">7</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7"
                                        data-bs-dismiss="modal" class="numberIcn" id="numberIcnButton_8" aria-label="Slide 8"><span
                                            data-bs-dismiss="modal">8</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="8"
                                        data-bs-dismiss="modal" class="numberIcn" id="numberIcnButton_9" aria-label="Slide 9">
                                        <span data-bs-dismiss="modal">9</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="9"
                                        data-bs-dismiss="modal" class="numberIcn" id="numberIcnButton_10" aria-label="Slide 10"><span
                                            data-bs-dismiss="modal">10</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{action('WebFrontend\ExamController@competitiveExamSubmit')}}" method="post" >
                    @csrf
                    <input type="hidden" name="examId" value="{{$id}}">

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
                            <button class="carousel-control-next" id="next" type="button"><span class="">Save & Next</span>
                            </button>
                            <button class="carousel-control-next"  id="formSubmit" type="submit" style="display:none;"><span class="">Submit</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </section>
@endsection
@section('customJavascript')
    <script>
        var examId = '{{ $id }}';
        let url = "{{ action('WebFrontend\ExamController@competitiveExamStart', ['id' => $id]) }}";
        var buttonType='';

        var questionLimit={{$questionLimit}};
        if(questionLimit==1)
        {
            $("#next").hide();
            $("#formSubmit").show();
        }

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
                                $('#exam-count').text($(this).attr("slide"));
                                var sliderNumber = $(this).attr("slide");
                                $("#numberIcnButton_"+(sliderNumber-1)).addClass('ic1');
                                if(sliderNumber==questionLimit)
                                {
                                    $("#next").hide();
                                    $("#formSubmit").show();
                                }
                                else{
                                    $("#next").show();
                                    $("#formSubmit").hide();
                                }
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
                                        $('#exam-count').text(parseInt($(this).attr("slide"))+1);
                                        $('#carouselExampleIndicators').carousel('next');
                                        var sliderNumber = $(this).attr("slide");
                                        $("#numberIcnButton_"+sliderNumber).addClass('ic2');


                                        if(questionLimit==(parseInt(sliderNumber)+1))
                                        {
                                            $("#next").hide();
                                            $("#formSubmit").show();
                                        }
                                        else{
                                            $("#next").show();
                                            $("#formSubmit").hide();
                                        }

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
                                        $('#carouselExampleIndicators').carousel('next');
                                        $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                        var sliderNumber = $(this).attr("slide");
                                        $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                        if(questionLimit==(parseInt(sliderNumber)+1))
                                        {
                                            $("#next").hide();
                                            $("#formSubmit").show();
                                        }
                                        else{
                                            $("#next").show();
                                            $("#formSubmit").hide();
                                        }
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
                                        $('#carouselExampleIndicators').carousel('next');
                                        $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                        var sliderNumber = $(this).attr("slide");
                                        $("#numberIcnButton_"+sliderNumber).addClass('ic2');
                                        if(questionLimit==(parseInt(sliderNumber)+1))
                                        {
                                            $("#next").hide();
                                            $("#formSubmit").show();
                                        }
                                        else{
                                            $("#next").show();
                                            $("#formSubmit").hide();
                                        }
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

                                        var curInputNammeArray = id.split("_");
                                        var questionId=curInputNammeArray[1];



                                        if(type != 'radio')
                                        {
                                            if($('#'+id).val()=='')
                                            {
                                                check = false;
                                            }
                                        }
                                        if(type == 'radio')
                                        {
                                            if($("input:radio[name="+name+"]:checked").length == 0)
                                            {
                                                check = false;
                                            }
                                        }

                                    }

                                    if($("#accounting2credit_"+questionId).val()==0 || $("#accounting2Debit_"+questionId).val()==0)
                                    {

                                        return event.preventDefault();
                                    }
                                    else
                                    {
                                        // if(!check){
                                        //     return event.preventDefault();
                                        // }
                                        // else
                                        // {
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');
                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();
                                            }
                                        // }
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
                                        $('#carouselExampleIndicators').carousel('next');
                                        $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                        var sliderNumber = $(this).attr("slide");
                                        $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                        if(questionLimit==(parseInt(sliderNumber)+1))
                                        {
                                            $("#next").hide();
                                            $("#formSubmit").show();
                                        }
                                        else{
                                            $("#next").show();
                                            $("#formSubmit").hide();
                                        }
                                    }
                                }
                                if (questionType === 'accounting4') 
                                {
                                    var curInputs = $(this).find("input[type='radio']");
                                    var check = true; 
                                    for (var i = 0; i < curInputs.length; i++) 
                                    {
                                        var type = curInputs[i].type;
                                        var name = curInputs[i].name;
                                        var id = curInputs[i].id;
                                        if(type == 'radio')
                                        {
                                            if($("input:radio[name="+name+"]:checked").length != 0)
                                            {
                                                var radio_check = $("input[name="+name+"]:checked").val();
                                                var radio_check_value_id = $("input[id="+id+"]:checked").val();
                                                var account_typr = $("input[name="+name+"]:checked").attr('divType');
                                                if(account_typr == 'assets' )
                                                {
                                                    if(radio_check == '1' && radio_check_value_id == '1') 
                                                    {                                         
                                                        if($("#"+id+"_Option").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Text").val() == undefined || $("input:text").val() == '') {
                                                            check = false;
                                                        }
                                                    }
                                                    if(radio_check == '2' && radio_check_value_id == '2') 
                                                    {
                                                        if($("#"+id+"_Option").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Text").val() == undefined || $("input:text").val() == '') {
                                                            check = false;
                                                        }
                                                    }
                                                }
                                                if(account_typr == 'liabilities' ) 
                                                {
                                                    if(radio_check == '1' && radio_check_value_id == '1')
                                                    {
                                                        if($("#"+id+"_Option1").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Option2").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Text").val() == undefined || $("input:text").val() == '') {
                                                            check = false;
                                                        }
                                                    }
                                                    if(radio_check == '2' && radio_check_value_id == '2') 
                                                    {
                                                        if($("#"+id+"_Option1").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Option2").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Text").val() == undefined || $("input:text").val() == '') {
                                                            check = false;
                                                        }
                                                    }
                                                }
                                                if(account_typr == 'equity' ) 
                                                {
                                                    if(radio_check == '1' && radio_check_value_id == '1') 
                                                    {                                  
                                                        if($("#"+id+"_Option1").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Option2").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Text").val() == undefined || $("input:text").val() == '') {
                                                            check = false;
                                                        }
                                                    }
                                                    if(radio_check == '2' && radio_check_value_id == '2')
                                                    {
                                                        if($("#"+id+"_Option1").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Option2").find('option:selected').val() == ''){
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Text").val() == undefined || $("input:text").val() == '') {
                                                            check = false;
                                                        }
                                                    }
                                                }                                                
                                            }
                                            else
                                            {
                                                check = false; 
                                            }
                                        }
                                    }
                                    if(!check)
                                    {                                       
                                        return event.preventDefault();
                                    }
                                    else
                                    {
                                        $('#carouselExampleIndicators').carousel('next');
                                        $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                        var sliderNumber = $(this).attr("slide");
                                        $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                        if(questionLimit==(parseInt(sliderNumber)+1))
                                        {
                                            $("#next").hide();
                                            $("#formSubmit").show();
                                        }
                                        else{
                                            $("#next").show();
                                            $("#formSubmit").hide();
                                        }
                                    }
                                }
                                if (questionType === 'accounting5')
                                {
                                    var curInputs = $(this).find("select");
                                    var check = true;
                                    for (var i = 0; i < curInputs.length; i++)
                                    {
                                        //var name = curInputs[i].name;
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
                                        $('#carouselExampleIndicators').carousel('next');
                                        $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                        var sliderNumber = $(this).attr("slide");
                                        $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                        if(questionLimit==(parseInt(sliderNumber)+1))
                                        {
                                            $("#next").hide();
                                            $("#formSubmit").show();
                                        }
                                        else{
                                            $("#next").show();
                                            $("#formSubmit").hide();
                                        }
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
                                        $('#carouselExampleIndicators').carousel('next');
                                        $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                        var sliderNumber = $(this).attr("slide");
                                        $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                        if(questionLimit==(parseInt(sliderNumber)+1))
                                        {
                                            $("#next").hide();
                                            $("#formSubmit").show();
                                        }
                                        else{
                                            $("#next").show();
                                            $("#formSubmit").hide();
                                        }
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

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
                                    @for ($i = 0; $i < $questionLimit; $i++)
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}"
                                            class="numberIcn" aria-current="true" id="numberIcnButton_{{$i+1}}" aria-label="Slide {{$i+1}}"><span
                                            data-bs-dismiss="modal">{{$i+1}}</span>
                                        </button>
                                    @endfor                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{action('WebFrontend\ExamController@examSubmit')}}" method="post" >
                    @csrf
                    <input type="hidden" name="examId" value="{{$id}}">
                    <input type="hidden" name="exam_type" value="3">

                    <div id="carouselExampleIndicators" class="carousel" data-bs-interval="false">
                        <div class="carousel-inner" id="questionHolder">
                        </div>
                        <div class="carouselFlow">
                            <button class="carousel-control-prev" type="button"><span class="">Previous</span>
                            </button>                        
                            <button class="carousel-control-next-skip" id="skip" type="button"><span class="">Skip</span>
                            </button>
                            <button class="carousel-control-next-skip" id="skipSubmit" type="submit" style="display:none;"><span class="">Skip & Submit</span>
                            </button>
                            <button class="carousel-control-next" id="next" type="button"><span class="">Save & Next</span>
                            </button>
                            <button class="carousel-control-next"  id="formSubmit" type="submit" style="display:none;"><span class="">Save & Submit</span>
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
        let url = "{{ action('WebFrontend\ExamController@assignmentExamQuestion', ['courseId' => $courseId,'chapterId'=>$chapterId]) }}";
        var buttonType='';

        var questionLimit={{$questionLimit}};
        if(questionLimit==1)
        {
            $("#next").hide();
            $("#formSubmit").show();

            $("#skip").hide();
            $("#skipSubmit").show();
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

                    $('.carousel-control-next-skip').click(function() 
                    {
                        var ifSliderSame=false;
                        $(".carousel-item").each(function()
                        {
                            if ($(this).hasClass("active"))
                            {                       
                                var sliderNumber = $(this).attr("slide");                               
                                if(sliderNumber==questionLimit)
                                {
                                    ifSliderSame=true;                                  
                                }
                                else{
                                    ifSliderSame=false;
                                }
                            }
                        });
                        if(!ifSliderSame){
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
                                        $("#skip").hide();
                                        $("#formSubmit").show();
                                        $("#skipSubmit").show();
                                    }
                                    else{
                                        $("#next").show();
                                        $("#skip").show();
                                        $("#formSubmit").hide();
                                        $("#skipSubmit").hide();
                                    }
                                }
                            });
                        }

                    });

                    $(".carousel-control-prev").click(function() {
                        $('#carouselExampleIndicators').carousel('prev');
                        $(".carousel-item").each(function() {
                            if ($(this).hasClass("active")) {
                                $('#exam-count').text($(this).attr("slide"));
                                var questionType = $(this).children(".questionType").val();

                                var sliderNumber = $(this).attr("slide");
                                if(sliderNumber==questionLimit)
                                {
                                    $("#next").hide();
                                    $("#formSubmit").show();

                                    $("#skip").hide();
                                    $("#skipSubmit").show();
                                }
                                else{
                                    $("#next").show();
                                    $("#formSubmit").hide();

                                    $("#skip").show();
                                    $("#skipSubmit").hide();
                                }
                            }
                        });

                    });

                    $('.carousel-control-next').click(function()
                    {
                        var ifSliderSame=false;
                        $(".carousel-item").each(function()
                        {
                            if ($(this).hasClass("active"))
                            {                       
                                var sliderNumber = $(this).attr("slide");                               
                                if(sliderNumber==questionLimit)
                                {
                                    ifSliderSame=true;                                  
                                }
                                else{
                                    ifSliderSame=false;
                                }
                            }
                        });
                        
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

                                    if(!check)
                                    {
                                        Swal.fire(
                                            'Oops!',
                                            'If you want to answer this question, please click one of the radio, after that you can click Save Button. Otherwise you can click Skip Button',
                                            'info'
                                        );
                                        return event.preventDefault();
                                    }
                                    else{
                                        if(!ifSliderSame){ 
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);
                                            $('#carouselExampleIndicators').carousel('next');
                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');


                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }
                                        return false;
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
                                        Swal.fire(
                                            'Oops!',
                                            'If you want to answer this question, please select the checkbox first, after that you can click Save Button. Otherwise you can click Skip Button',
                                            'info'
                                        );
                                        return event.preventDefault();
                                    }
                                    else
                                    {                                        
                                        if(!ifSliderSame)
                                        {
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }                                        
                                        return false;
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
                                        Swal.fire(
                                            'Oops!',
                                            'If you want to answer this question, please select the checkbox first, after that you can click Save Button. Otherwise you can click Skip Button',
                                            'info'
                                        );
                                        return event.preventDefault();
                                    }
                                    else{

                                        if(!ifSliderSame)
                                        {
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');
                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }                                        
                                        return false;
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

                                    if($("#accounting2credit_"+questionId).val()==0 || $("#accounting2Debit_"+questionId).val()==0 || ($("#accounting2credit_"+questionId).val() != $("#accounting2Debit_"+questionId).val()))
                                    {

                                        Swal.fire(
                                            'Oops!',
                                            'Check your total Debit/Credit value is same and also graterthan 0.',
                                            'error'
                                            );
                                        return event.preventDefault();                                        
                                    }
                                    else
                                    {      
                                        if(!ifSliderSame){   
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');
                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }  
                                        return false;
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
                                        Swal.fire(
                                            'Oops!',
                                            'If you want to answer this question, please select the value first, after that you can click Save Button. Otherwise you can click Skip Button',
                                            'info'
                                        );
                                        return event.preventDefault();
                                    }
                                    else{
                                        if(!ifSliderSame)
                                        {
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }                                        
                                        return false;
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
                                                            console.log('select');
                                                            check = false;
                                                        }
                                                        if($("#"+id+"_Text").val() == undefined || $("input:text").val() == '') {
                                                            console.log('select 2');
                                                            check = false;
                                                        }
                                                    }
                                                    if(radio_check == '2' && radio_check_value_id == '2')
                                                    {
                                                        console.log('select 3');
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
                                        Swal.fire(
                                            'Oops!',
                                            'If you want to answer this question, please select the value first, after that you can click Save Button. Otherwise you can click Skip Button',
                                            'info'
                                        );
                                        return event.preventDefault();
                                    }
                                    else
                                    {
                                        if(!ifSliderSame)
                                        {
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }                                        
                                        return false;
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
                                        Swal.fire(
                                            'Oops!',
                                            'If you want to answer this question, please select the value first, after that you can click Save Button. Otherwise you can click Skip Button',
                                            'info'
                                        );
                                        return event.preventDefault();
                                    }
                                    else{

                                        if(!ifSliderSame)
                                        {
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }                                        
                                        return false;
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
                                        Swal.fire(
                                            'Oops!',
                                            'If you want to answer this question, please select the value first, after that you can click Save Button. Otherwise you can click Skip Button',
                                            'info'
                                        );
                                        return event.preventDefault();
                                    }
                                    else{

                                        if(!ifSliderSame)
                                        {
                                            $('#carouselExampleIndicators').carousel('next');
                                            $('#exam-count').text(parseInt($(this).attr("slide"))+1);

                                            var sliderNumber = $(this).attr("slide");
                                            $("#numberIcnButton_"+sliderNumber).addClass('ic2');

                                            if(questionLimit==(parseInt(sliderNumber)+1))
                                            {
                                                $("#next").hide();
                                                $("#formSubmit").show();

                                                $("#skip").hide();
                                                $("#skipSubmit").show();
                                            }
                                            else{
                                                $("#next").show();
                                                $("#formSubmit").hide();

                                                $("#skip").show();
                                                $("#skipSubmit").hide();
                                            }
                                        }                                        
                                        return false;
                                    }
                                }
                            }
                            
                        });
                        
                    });
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

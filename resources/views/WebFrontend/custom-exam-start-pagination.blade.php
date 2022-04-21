@foreach ($question as $key => $val)
<div class="innerlist-item quizList">
    <span class="countopt">{{ $question->currentPage() }}</span>
    <div class="item_details">
        <p class="detlNewFont">{{ $val->qus }}</p>
        <div class="item_desc">
            <div class="item_morecontent">
                <div class="item_checkoutopt icFlex">
                    @if (@$val->qus_option)
                    @foreach ($val->qus_option as $option)
                    <div class="checkbtn_opt">
                        <input type="radio" id="test1" name="radio-group" checked>
                        <label for="test1">{{ $option }}</label>
                    </div>
                    @endforeach
                    @endif



                </div>
                <div class="actionview">

                    <button type="button" class="btn ansbtn">Answered</button>
                    <button type="button" class="btn skippedbtn">Skipped</button>
                    <button type="button" class="btn revdbtn">Marked for Review</button>

                </div>
            </div>


            <!-- <div class="actionview2">
                           <button type="button" class="btn prevbtn_info">Previous</button>
                           <button type="button" class="btn sub_btn">Submit</button>
                       </div> -->
        </div>
    </div>
</div>

<script>
    $(".ansbtn").click(function() {
        $(this).addClass("active-green");
        $(".skippedbtn").removeClass("active-yellow");
        $(".revdbtn").removeClass("active-blue");
    });
    $(".skippedbtn").click(function() {
        $(this).addClass("active-yellow");
        $(".ansbtn").removeClass("active-green");
        $(".revdbtn").removeClass("active-blue");
    });
    $(".revdbtn").click(function() {
        $(this).addClass("active-blue");
        $(".ansbtn").removeClass("active-green");
        $(".skippedbtn").removeClass("active-yellow");
    });

</script>
@endforeach

{{-- <div class="def_btn_opt morebtn_info">
       <a href="#" class="def_btn prevbtn">Previous</a>
       <a href="{{route('exam-submit')}}" class="def_btn">Skip</a>
<a href="#" class="def_btn nextbtn">Next</a>
</div> --}}

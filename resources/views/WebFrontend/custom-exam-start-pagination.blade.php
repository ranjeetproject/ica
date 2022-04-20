 <div class="inner_content_view">
    <div class="inner_block">
        @foreach ($data as $key=>$val)
            <div class="innerlist-item">
                <span class="countopt" >{{$key+1}}</span>
                <div class="item_details"><p>{{$val->qus}}</p>
                    <div class="item_desc">
                        <div class="item_morecontent">
                            <div class="item_checkoutopt">
                            @if(@$val->qus_option)
                                @foreach ($val->qus_option as $option)
                                    <div class="checkbtn_opt">
                                        <input type="radio" id="test1" name="radio-group" checked>
                                        <label for="test1">{{$option}}</label>
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
        @endforeach
        <input type="hidden" value={{@$id}} id="exam_id"/>
    </div>
   
    {{-- <div class="def_btn_opt morebtn_info">
        <a href="#" class="def_btn prevbtn">Previous</a>
        <a href="{{route('exam-submit')}}" class="def_btn">Skip</a>
        <a href="#" class="def_btn nextbtn">Next</a>
    </div>
     --}}
     <div class="def_btn_opt morebtn_info">
            <a class="def_btn prevbtn" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            <a href="{{route('exam-submit')}}" class="def_btn">Skip</a>
            <a class="def_btn nextbtn" href="{{ $paginator->nextPageUrl() }}">Next</a>
    </div>   
</div>
 
 
 
        

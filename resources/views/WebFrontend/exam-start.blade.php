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
                    Name of Exams
                    <span class="blue-bar"></span>
                </h3>
                <div class="dateoption">
                    <div class="dateinfo"><span>Date : </span><strong>11 - 05 - 2020</strong></div>
                    <div class="timeinfo"><span class="clockimg"><img src="images/clockimg.png" alt="">
                    </span> <strong> 01:15:35 </strong><span> Remaining</span></div>
                </div>
            </div>
            
            <div class="inner_content_info">
               
                <div class="inner_content_view">
                    <div class="inner_block">
                      
                        <div class="innerlist-item">
                            <span class="countopt" >1</span>
                            <div class="item_details"><p>Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.</p>
                                <div class="item_desc">
                                    <div class="item_morecontent">
                                        <div class="item_checkoutopt">
                                            <div class="checkbtn_opt">
                                                <input type="radio" id="test1" name="radio-group" checked>
                                                <label for="test1">Effective communication</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="test2" name="radio-group">
                                                <label for="test2">Optimism</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="test3" name="radio-group">
                                                <label for="test3">Delegation</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="test4" name="radio-group">
                                                <label for="test4">Optimism</label>
                                            </div>
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
                        <div class="innerlist-item">
                            <span class="countopt">2</span>
                            <div class="item_details">Magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.
                                <div class="item_desc">
                                    <div class="item_morecontent">
                                        <div class="item_checkoutopt">
                                            <div class="checkbtn_opt">
                                                <input type="radio" id="2grouptest1" name="radio-2group" checked>
                                                <label for="2grouptest1">Effective communication</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="2grouptest2" name="radio-2group">
                                                <label for="2grouptest2">Optimism</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="2grouptest3" name="radio-2group">
                                                <label for="2grouptest3">Delegation</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="2grouptest4" name="radio-2group">
                                                <label for="2grouptest4">Optimism</label>
                                            </div>
                                        </div>
                                        <div class="actionview">
                                            
                                            <button type="button" class="btn ansbtn">Answered</button>
                                            <button type="button" class="btn skippedbtn">Skipped</button>
                                            <button type="button" class="btn revdbtn">Marked for Review</button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="innerlist-item">
                            <span class="countopt">2</span>
                            <div class="item_details">Magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, Ut enim ad minima veniam.
                                <div class="item_desc">
                                    <div class="item_morecontent">
                                        <div class="item_checkoutopt">
                                            <div class="checkbtn_opt">
                                                <input type="radio" id="3grouptest1" name="radio-3group" checked>
                                                <label for="3grouptest1">Effective communication</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="3grouptest2" name="radio-3group">
                                                <label for="3grouptest2">Optimism</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="3grouptest3" name="radio-3group">
                                                <label for="3grouptest3">Delegation</label>
                                            </div>
                                              <div class="checkbtn_opt">
                                                <input type="radio" id="3grouptest4" name="radio-3group">
                                                <label for="3grouptest4">Optimism</label>
                                            </div>
                                        </div>
                                        <div class="actionview">
                                            
                                            <button type="button" class="btn ansbtn">Answered</button>
                                            <button type="button" class="btn skippedbtn">Skipped</button>
                                            <button type="button" class="btn revdbtn">Marked for Review</button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                       
                    </div>
               

                    <div class="def_btn_opt morebtn_info">
                        <a href="#" class="def_btn prevbtn">Previous</a>
                        <a href="{{route('exam-submit')}}" class="def_btn">Skip</a>
                        <a href="#" class="def_btn nextbtn">Next</a>
                    </div>
                     
                    
                </div>

            </div>
        </div>
    </section>



@endsection
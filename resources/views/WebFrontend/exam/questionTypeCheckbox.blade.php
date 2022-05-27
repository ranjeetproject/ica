<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    @if($question->qus_image!=null)
        <div class="qslImg"><img src="{{ $question->qus_image }}" alt="" title="" /></div>
    @endif
    <div class="item_desc">
        <div class="item_morecontent">
            <div class="item_checkoutopt">
                @foreach ($question->qus_option as $key => $option)
                    <div class="checkbtn_opt">
                        <input type="checkbox" id="questionOption_{{$question->id}}_{{$key}}_{{ $option }}" 
                        name="checkboxType_{{$question->id}}[]" class="checkboxType" value={{$key+1}}>
                        <label for="questionOption_{{$question->id}}_{{$key}}_{{ $option }}">{{ $option }}</label>
                    </div>
                @endforeach
            </div>
            {{-- <div class="actionview">
                <button type="button" class="btn ansbtn">Answered</button>
                <button type="button" class="btn skippedbtn">Skipped</button>
                <button type="button" class="btn revdbtn">Marked for Review</button>
            </div> --}}
        </div>
    </div>
</div>

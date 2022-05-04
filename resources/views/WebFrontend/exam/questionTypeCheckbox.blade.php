<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    <div class="item_desc">
        <div class="item_morecontent">
            <div class="item_checkoutopt">
                @foreach ($question->qus_option as $key => $option)
                    <div class="checkbtn_opt">
                        <input type="checkbox" id="questionOption_{{$question->id}}_{{$key}}_{{ $option }}" name="checkboxType_{{$question->id}}" class="checkboxType">
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
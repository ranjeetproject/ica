<div class="questionBlock">
    <p>{{ $question->indexKey }}. Select appropriate option from dropdown list</p>
    <div class="qbSelect">
        @foreach($question->qus as $key=>$questionOption)
            <label>{{$questionOption}}</label>
            <select class="form-select" aria-label="Default select example" name="accounting5_{{$key}}_{{$question->id}}"
                id="accounting5_{{$key}}_{{$question->id}}">
                <option selected value=''>Select</option>
                @foreach($question->qus_option as $keyPair => $option)
                    <option value="{{$keyPair+1}}">{{$option}}</option>
                @endforeach
            </select>
        @endforeach
    </div>
</div>

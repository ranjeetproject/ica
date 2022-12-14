<div class="questionBlock">
    <p>{{ $question->indexKey }}. Select appropriate option from dropdown list</p>
    @if($question->qus_image!=null)
        <div class="qslImg"><img class="imgZoom" src="{{ $question->qus_image }}" alt="" title=""/></div>
    @endif
    <div class="qbSelect">
       
            @foreach($question->qus as $key=>$questionOption)
                <div class="qbSelectB">
                    <label>{{$questionOption}}</label>
                    <select class="form-select" aria-label="Default select example" name="accounting5_{{$question->id}}[]"
                        id="accounting5_{{$key}}_{{$question->id}}">
                        <option selected value=''>Select</option>
                        @foreach($question->qus_option as $keyPair => $option)
                            <option value="{{$keyPair+1}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        
    </div>
</div>

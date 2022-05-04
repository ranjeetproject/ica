<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    <div class="qslImg"><img src="{{ $question->qus_image }}" alt="" title="" /></div>
    <div class="qbSelect nullSelect">
        <div class="qbSelectB">
            <label>Choose correct account type</label>
            <select class="form-select" aria-label="Default select example" name="accounting3SelectOption_{{$question->id}}" 
                id="accounting3SelectOption_{{$question->id}}">
                <option selected value=''>Select</option>
                @foreach ($question->qus_option as $questionOptionValue)
                    <option value="{{ $loop->index }}">{{ $questionOptionValue }}
                    </option>
                @endForeach
            </select>
        </div>
    </div>
</div>

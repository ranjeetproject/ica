<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    @if($question->qus_image!=null)
        <div class="qslImg img-zome"><img src="{{ $question->qus_image }}" alt="" title="" /></div>
    @endif
    <div class="qbSelect nullSelect">
        <div class="qbSelectB">
            <label>Choose correct account type</label>
            <select class="form-select" aria-label="Default select example" name="accounting3_SelectOption_{{$question->id}}" 
                id="accounting3SelectOption_{{$question->id}}">
                <option selected value=''>Select</option>
                @foreach ($question->qus_option as $questionOptionValue)
                    <option value="{{ $loop->index+1 }}">{{ $questionOptionValue }}
                    </option>
                @endForeach
            </select>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#img-zome").jqZoom({
            selectorWidth: 30,
            selectorHeight: 30,
            viewerWidth: 400,
            viewerHeight: 300
        });
    })
</script>

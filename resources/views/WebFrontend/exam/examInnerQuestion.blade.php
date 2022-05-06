<input type="hidden" name="total_marks" value="{{$fullMarks}}">
@foreach ($data as $question)
    <div class="carousel-item @if ($loop->iteration == 1) active @endif" slide="{{ $loop->iteration }}">
        @if ($question->type === 'radio')
            <input type="hidden" name="questionType" class="questionType" value="radio">
            @include('WebFrontend.exam.questionTypeRadio', $question)
        @elseif ($question->type === 'check')
            <input type="hidden" name="questionType" class="questionType" value="check">
            @include('WebFrontend.exam.questionTypeCheckbox', $question)
        @elseif ($question->type === 'accounting1')
            <input type="hidden" name="questionType" class="questionType" value="accounting1">
            @include('WebFrontend.exam.questionTypeAccounting1', $question)
        @elseif ($question->type === 'accounting2')
            <input type="hidden" name="questionType" class="questionType" value="accounting2">
            @include('WebFrontend.exam.questionTypeAccounting2', $question)
        @elseif ($question->type === 'accounting3')
            <input type="hidden" name="questionType" class="questionType" value="accounting3">
            @include('WebFrontend.exam.questionTypeAccounting3', $question)
        @elseif ($question->type === 'accounting4')
            <input type="hidden" name="questionType" class="questionType" value="accounting4">
            @include('WebFrontend.exam.questionTypeAccounting4', $question)
        @elseif ($question->type === 'accounting5')
            <input type="hidden" name="questionType" class="questionType" value="accounting5">
            @include('WebFrontend.exam.questionTypeAccounting5', $question)
        @elseif ($question->type === 'accounting6')
            <input type="hidden" name="questionType" class="questionType" value="accounting6">
            @include('WebFrontend.exam.questionTypeAccounting6', $question)
        @endif
    </div>
@endforeach

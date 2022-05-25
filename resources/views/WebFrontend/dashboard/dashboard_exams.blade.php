@foreach ($exams as $exam)
    <div class="col-md-4">
        <div class="course-card db-cards">
            {{-- @if ($exam->courseDetails->course_photo == null) --}}
            @if($exam->exam_image!='')
                <img src="{{$exam->exam_image}}" class="course-image" alt="#">
            @else
                <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="exam-image">
            @endif
            {{-- @else
                <img src="{{ $exam->courseDetails->course_photo }}" class="course-image" alt="#"> --}}
            {{-- @endif --}}
            <div class="total-lesson">
                <img src="{{ asset('css/images/lesson-icon.png') }}" class="img-flid" alt="#">
                <span>{{ $exam->exam_code }}</span>
            </div>
            <div class="title-w-icon">
                <h4 class="course-name">
                    {{ $exam->exam_name }}    
                </h4>
                <a href="{{url('exam-instruction',$exam->ex_id)}}">
                    <img src="{{ asset('css/images/plus-icon.svg') }}" class="img-fluid" />
                </a>
            </div>
        </div>
    </div>
@endforeach
@foreach ($courses as $course)
    <div class="col-md-4">
        <div class="course-card db-cards">
            @if ($course['course_photo'] != null)
                <img src="{{ $course['course_photo'] }}" class="course-image" alt="#">
            @else
                <img src="{{ asset('css/images/course-image.jpg') }}" class="course-image" alt="#">
            @endif
            <div class="title-w-icon">
                <h4 class="course-name">{{ $course['course_name'] }} </h4>
                <a href="{{url('course-details', $course['course'])}}">
                    <img src="{{ asset('css/images/plus-icon.svg') }}" class="img-fluid" />
                </a>
            </div>
        </div>
    </div>
@endforeach
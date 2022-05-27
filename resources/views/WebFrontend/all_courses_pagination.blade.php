@foreach ($data as $course)
    <div class="course-card">
    @if($course->course_photo!='')
        <img src="{{$course->course_photo}}" class="course-image" alt="#" />
    @else
        <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#">
    @endif
        <div class="total-lesson">
            <img src="{{asset('css/images/lesson-icon.png')}}" class="img-flid" alt="#">
            <span>{{count($course->lessons)}} Lessons</span>
        </div>
        <h4 class="course-name">{{$course->course_name}}
        </h4>
        {{-- <div class="rating">
            <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
            <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
            <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
            <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
            <img src="{{asset('css/images/outline-star.svg')}}" class="img-flid">
            <span>4.50(2)</span>
        </div> --}}
    </div>
@endforeach
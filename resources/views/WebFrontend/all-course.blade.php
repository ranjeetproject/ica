@foreach ($data as $courses)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="course-card">
            <img src="{{$courses->course_photo}}" class="course-image" alt="#">
            <h4 class="course-name">{{$courses->course_name}} </h4>
            <a href="{{ url('course-details', $courses->id) }}" class="btn view">view</a>
        </div>
    </div>
@endforeach
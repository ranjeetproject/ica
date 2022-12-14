@extends((\Auth::check())?'WebFrontend.layout.afterLoginApp':'WebFrontend.layout.app')
@section('content')
    @if(Auth::check())
        <section class="header">
            <div class="header-top">
                @include('WebFrontend.layout.afterLoginHeaderTop')
            </div>
            <div class="header-bottom">
                @include('WebFrontend.layout.afterLoginNav')
            </div>
        </section>
    @else
        @include('WebFrontend.layout.previousLoginNav')
    @endif

<section class="banner-wrp" style="background: url('https://demos.mydevfactory.com/android/public/cms_images/{{@$homeCms->featured_image}}') no-repeat top right background-size: contain;;
">
    <img src="{{asset('css/images/dot-group-top.png')}}" class="img-fluid top_icon" alt="#">
    <div class="ban-content">
        <h1 class="cont-head">
            100% Job <span>Guarantee Online </span>& Offline Courses<span> with 1000+Quizes</span> from India’s
            No. 1 Vocational Training Institute
        </h1>
        <p class="cont-para">
           Industry-oriented Accounts & Finance Courses
        </p>
        <div class="but-wrap">
            <img src="{{asset('css/images/point-arrow.svg')}}" class="img-fluid point-arrow" alt="#">
            <img src="{{asset('css/images/dot-group.png')}}" class="img-fluid bottom_icon" alt="#">
            <a href="{{route('login')}}" class="btn common-button">Explore All Courses</a>
        </div>
    </div>
</section>
<!-- end banner -->

<section class="how-it-works">
    <div class="container">
        <div class="h-header-wrp">
            <p>How it Works</p>
            {!!$howItWork->heading_title!!}
        </div>
        <div class="h-cards-wrp">
            <div class="card">
                <span class="count-no">1</span>
                <img src="{{asset('css/images/how-connector.png')}}" alt="#" class="img-fluid conntector" />
                <div class="card-body">
                    <img src="https://demos.mydevfactory.com/android/public/howItWork_image/{{$howItWork->image_one}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">{{$howItWork->title_one}}</h4>
                        {{-- <p>Don numq modi</p> --}}
                    </div>
                </div>
            </div>
            <div class="card">
                <span class="count-no">2</span>
                <img src="{{asset('css/images/how-connector.png')}}" alt="#" class="img-fluid conntector" />
                <div class="card-body">
                    <img src="https://demos.mydevfactory.com/android/public/howItWork_image/{{$howItWork->image_two}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">{{$howItWork->title_two}}</h4>
                        {{-- <p>Don numq modi</p> --}}
                    </div>
                </div>
            </div>
            <div class="card">
                <span class="count-no">3</span>
                <img src="{{asset('css/images/how-connector.png')}}" alt="#" class="img-fluid conntector" />
                <div class="card-body">
                    <img src="https://demos.mydevfactory.com/android/public/howItWork_image/{{$howItWork->image_three}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">{{$howItWork->title_three}}</h4>
                        {{-- <p>Don numq modi</p> --}}
                    </div>
                </div>
            </div>
            <div class="card">
                <span class="count-no">4</span>
                <div class="card-body">
                    <img src="https://demos.mydevfactory.com/android/public/howItWork_image/{{$howItWork->image_four}}" class="img-icon img-fluid" alt="#">
                    <div class="content">
                        <h4 class="c-text">{{$howItWork->title_four}}</h4>
                        {{-- <p>Don numq modi</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end how it works -->

<section class="courses-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <p class="courses-tag">Courses </p>
                <h2 class="course-head"> {{$homePageCourseHeader->title}}</h2>
            </div>
            <div class="col-md-7 textmidf">
                <p class="corse-hints">{!!$homePageCourseHeader->content!!}</p>
            </div>
        </div>
        <div class="home-courses">
            @foreach($courses as $value)
            <a class="nav-link" href="{{route('all-courses')}}">
            <div class="course-card">
                @if($value->course_photo == null)
                <img src="{{asset('css/images/course-image.jpg')}}" class="course-image" alt="#" />
                @else
                <img src="{{$value->course_photo}}" class="course-image" alt="#" />
                @endif
                <div class="total-lesson">
                    <img src="{{asset('css/images/lesson-icon.png')}}" class="img-flid" alt="#">
                    <span>{{$value->lessons->count()}} Lessons</span>
                </div>
                <h4 class="course-name">{{$value->course_name}}
                </h4>
                <div class="rating">
                    @if($value->rating == 0.5 || $value->rating == 1.5 || $value->rating == 2.5 || $value->rating == 3.5 || $value->rating == 4.5)
                        @for($i=0 ; $i<$value->rating-1 ; $i++)
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
                        @endfor
                        <img src="{{asset('css/images/outline-star.svg')}}" class="img-flid">
                    @else
                        @for($i=0 ; $i<$value->rating ; $i++)
                        <img src="{{asset('css/images/full-star.svg')}}" class="img-flid">
                        @endfor
                    @endif
                    <span>4.50({{$value->stdCount}})</span>
                </div>
                <div class="course-by-wrp">
                    @if($value->user->profile_image == null)
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    @else
                    <img src="{{$value->user->profile_image}}" class="ins-avt" alt="#" />
                    @endif
                    <div class="avt-name">
                        <span>by</span>
                        {{$value->user->name}}
                    </div>
                </div>
            </div>
            </a>
            @endforeach
        </div>
        <div class="view-all-course">
            <a href="{{route('all-courses')}}" class="btn common-button">View All Courses</a>
        </div>
    </div>
</section>
<!-- end course-wrap -->
<section class="courses-wrap testimonials">
    <div class="container">
        <div class="top-head">
            <p class="courses-tag">Testimonials </p>
            <h2 class="course-head">You can go through the testimonials of different students, who was placed
            after completing these courses from ICA.
            </h2>
        </div>

        <div class="home-courses">
            @foreach($testimonial as $value)
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>{{$value->title}}</h3>
                    {!!$value->description!!}
                   <a  onclick="getData({{$value->id}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="readMore">Read More</a>

                </div>
                <div class="course-by-wrp">
                    <img src="https://demos.mydevfactory.com/android/public/testimonial_images/{{$value->user_image}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> {{$value->username}}</label>
                        <p class="desg">{{$value->designation}}</p>
                    </div>

                </div>
            </div>
            @endforeach
            <!-- Button trigger modal -->
        

        <!-- Modal -->
        

            <!-- <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="./images/inst-avatar.png" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div>
            <div class="course-card">
                <div class="t-quotes-card">
                    <img src="{{asset('css/images/quote_icon.svg')}}" class="img-fluid quote-icon" />
                    <h3>Best Support ever!</h3>
                    <p>
                        5 stars for design quality, but
                        also for prompt new
                        customer service and great
                        attention to details work.

                    </p>
                </div>
                <div class="course-by-wrp">
                    <img src="{{asset('css/images/inst-avatar.png')}}" class="ins-avt" alt="#" />
                    <div class="avt-name">
                        <label> Alex Brown</label>
                        <p class="desg">Principal</p>
                    </div>

                </div>
            </div> -->
        </div>
        {{-- <div class="view-all-course">
            <a href="#" class="btn common-button">View All</a>
        </div> --}}
    </div>
</section>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="testimonialTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body" id="testimonialDescription">
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div> --}}
                </div>
            </div>
        </div>
@endsection
@section('customJavascript')
<script>
function getData(id){
    var dataValue = {
                    id: id,
                }
    var baseUrl = '{{action("WebFrontend\HomePageController@allTestimonials")}}';
                $.ajax({
                    type: 'get',
                    url: baseUrl,
                    data: dataValue,
                    success: function (data) {
                        if (data.success == true) {
                            $("#testimonialTitle").html(data.testimonial.title);
                            $("#testimonialDescription").html(data.testimonial.description);
                        }else{
                            $("#testimonialTitle").html('');
                            $("#testimonialTitle").html('');

                        }
                    }
                });
}
</script>
@endsection
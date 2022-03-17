@if(Auth::check())
@extends('WebFrontend.layout.afterLoginApp')
@else
@extends('WebFrontend.layout.app')
@endif

@section('content')

@include((Auth::check())?'WebFrontend.layout.afterLoginNav':'WebFrontend.layout.previousLoginNav')
    <section class="course-header">
        <div class="container">
            <p class="courses-title">About Us</p>
        </div>
    </section>

    <section class="crs-dtls-wrp">
        <div class="container">

            <div class="contents textalign_justify">
                <div class="innerinfo">
                    <div class="innerinfo_left">
                        <p class="sub-para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                        </p>
                        <p class="para-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </p>
                    </div>
                    <div class="innerinfo_right">
                        <div class="addimg">
                           <!--  <img class="img-fluid desktoppic" src="{{asset('css/images/signup-banner-left.jpg')}}" alt="" /> -->
                            <img class="img-fluid mobilepic"  src="{{asset('css/images/aboutinfo.png')}}" alt="" />
  
                        </div>
                    

                    </div>

                </div>
           



                <div class="title-part">
                    <span>Our Mission</span>
                    <span class="bar"></span>
                </div>
                <p class="para-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                </p>

                <ul class="nav about-list">
                    <li class="nav-item">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        Neque porro quisquam est, qui dolorem ipsum
                        quia dolor sit amet, Ut enim ad minima veniam.</li>
                    <li class="nav-item">Dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem ipsum quia dolor sit amet, Ut
                        enim ad minima veniam.</li>
                    <li class="nav-item">Ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum.
                    </li>
                </ul>


                <div class="title-part">
                    <span>Our vision</span>
                    <span class="bar"></span>
                </div>
                <p class="para-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                </p>

                <ul class="nav about-list">
                    <li class="nav-item">Quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        Neque porro quisquam est, qui dolorem ipsum
                        quia dolor sit amet, Ut enim ad minima veniam.</li>
                    <li class="nav-item">Dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                        qui dolorem ipsum quia dolor sit amet, Ut
                        enim ad minima veniam.</li>
                    <li class="nav-item">Ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum.
                    </li>
                </ul>
               
                <p class="para-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <p class="para-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>

            </div>
        </div>
    </section>

@endsection
@extends('WebFrontend.layout.afterLoginApp')
@section('content')
<section class="header">
    <div class="header-top">
        @include('WebFrontend.layout.afterLoginHeaderTop')
    </div>
    <div class="header-bottom">
        @include('WebFrontend.layout.afterLoginNav')
    </div>

</section>

<section class="crs-dtls-wrp">
    <div class="container">
        <div class="profileHdn">
            <h2>Profile</h2>
        </div>
        <div class="profileBg">
            <div class="profileBanner">
                <!--
                    <div class="profileIcom">
                        <img src="images/profile-avatar.jpg" alt="" />
                    </div>-->
                <div class="logoContainer">
                    @if(Auth::user()->profile_image!='')
                    <img src="{{Auth::user()->profile_image}}" alt="profile_image" id="profile_picture_image" />
                    @else
                    <img src="{{asset('css/images/profile-avatar.jpg')}}" alt="profile_image" id="profile_picture_image" />
                    @endif
                </div>

                <div class="profileTxt">
                    <h2>{{Auth::user()->name}}</h2>
                    <h5>{{Auth::user()->email}}</h5>
                    <p></p>
                    {{-- <p>Last seen 2 hours ago</p> --}}
                    <div class="fileContainer sprite">
                        <span><i class="far fa-camera"></i> Change Photo</span>
                        <input type="file" name="profile_picture" id="profile_picture" onchange="uploadProfileImage()">
                    </div>
                </div>
            </div>
            {{-- <div class="profileHdn profsubhdn">
                <h2>Basic</h2>
            </div> --}}
            <div class="profileForm newProfileform">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Code</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{Auth::user()->code}}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{Auth::user()->name}}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Phone No.</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{Auth::user()->mobile}}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" readonly class="form-control" value="{{Auth::user()->email}}" />
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Center Details</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{@$center->Center_code}} , {{@$center->Center_name}} , {{@$center->Center_address}}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{Auth::user()->state}}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{Auth::user()->city}}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Pincode</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{Auth::user()->pincode}}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="{{Auth::user()->address}}" />
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="formButton">
                    <a class="btn btn-primary mb-3" href="{{url('edit-profile',Auth::user()->id)}}">Edit Profile</a>
                </div>
            </div>
            <div class="courseDetlMain">
                @if(count($batch)>0)
                <div class="detlTable">
                    <h3>Batch Details</h3>
                    @foreach ($batch as $val)
                    <p>Batch: {{$val->batch}}</p>
                    <p>Year: {{$val->classyear}}</p>
                    @endforeach
                </div>
                @endif
                @if(count($courses)>0)
                <div class="detlTable">
                    <h3>Course Details</h3>
                    {{-- <ul>
                        @foreach ($courses as $course)
                        <li><span><i class="far fa-angle-double-right"></i></span> <a href="{{ url('course-details', $course->course) }}">{{$course->course_name}}</a></li>
                        @endforeach
                    </ul> --}}
                    <div class="inner_cont_wap">
                    @if (isset($apiData['courses']))
                        @foreach($apiData['courses'] as $value)
                            <a href="{{action('WebFrontend\CourseController@particulerAcademicDetailFetch',['id'=>@$value['courseid']])}}">
                                <div class="list-item certified_opt">
                                    <div class="item_details">
                                        <p class="titleopt">{{@$value['coursename']}} </p>
                                        <p class="date_opt">Admission Date : {{@$value['admission']}}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p class="noDt">No Data Available</p>
                    @endif
                        
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image Before Upload</h5>
                        <button type="button" class="closeBtn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="profile_sample_image" style="width:100%;overflow: hidden;" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>
<style>
    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

</style>
@endsection
@section('customJavascript')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var $profileModal = $('#modal');
    var profileImage = document.getElementById('profile_sample_image');
    var profileCropper;

    function uploadProfileImage() {
        var profileFiles = document.getElementById('profile_picture').files[0];
        profileImage.src = URL.createObjectURL(profileFiles);
        $profileModal.modal('show');
    }

    $profileModal.on('shown.bs.modal', function() {
        profileCropper = new Cropper(profileImage, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview',
            setDragMode: 'move'
        });
    }).on('hidden.bs.modal', function() {
        profileCropper.destroy();
        profileCropper = null;
    });

    $('#crop').click(function() {
        cover_canvas = profileCropper.getCroppedCanvas({
            width: 600,
            height: 600
        });

        cover_canvas.toBlob(function(blob) {
            file = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);

            var inputPreviewBox = document.getElementById('profile_picture_image');
            reader.onloadend = function() {
                var base64data = reader.result;
                var formData = new FormData();
                let url = "{{action('WebFrontend\DashboardController@profileImage')}}";
                formData.append('profile_picture', base64data);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    xhr: function() {
                        $("#progress").show();
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                var percentValue = percentComplete + '%';
                                $("#progressBar").css('width', '' + percentValue + '');
                            }
                        }, false);
                        return xhr;
                    },
                    complete: function(xhr) {
                        if (xhr.responseText && xhr.responseText != "error") {
                            $profileModal.modal('hide');
                            $("#progress").hide();
                            inputPreviewBox.src = xhr.responseText;
                            $('#profile_image_header').attr('src', xhr.responseText);
                        } else {
                            $profileModal.modal('hide');
                            $("#progressBar").stop();
                            $("#progress").stop();
                            $("#progress").hide();

                            alert("OOPs, Something is wrong!", 'Problem in uploading file', "error")

                        }
                    }
                });
            };

        });
    });
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        {{ Session::forget('success') }};
    @endif


    @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif


    @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
@endsection

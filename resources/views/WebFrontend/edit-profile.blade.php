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
                <h2>Edit Profile</h2>
            </div>
            <div class="profileBg">
                <div class="profileBanner">
                    <div class="profileIcom">
                    @if(Auth::user()->profile_image!='')
                        <img src="{{Auth::user()->profile_image}}" alt="profile_image" id="profile_picture_image"/>
                    @else
                        <img src="{{asset('css/images/profile-avatar.jpg')}}" alt="profile_image" id="profile_picture_image"/>
                    @endif
                    </div>
                    <div class="profileTxt">
                        <h2>{{Auth::user()->name}}</h2>
                        <h5>{{Auth::user()->email}}</h5>
                        <p></p>
                        {{-- <p>Last seen 2 hours ago</p> --}}
                        <div class="fileContainer sprite">
                            <span><i class="far fa-camera"></i> Change Photo</span>
                            <input type="file" name="profile_picture" id="profile_picture"
                                                       onchange="uploadProfileImage()">
                        </div>
                    </div>
                </div>
                <div class="profileHdn profsubhdn">
                    <h2>Basic</h2>
                </div>
                <div class="profileForm">
                    <form action="{{ action('WebFrontend\DashboardController@updateProfilePage',[$profileData->id])}}" method="POST">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="code" value="{{$profileData->code}}" readonly/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="{{$profileData->name}}" readonly/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Phone No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mobile" value="{{$profileData->mobile}}" readonly/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" value="{{$profileData->email}}" readonly />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Center Details</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" name="center"  value="{{@$center->Center_code}} , {{@$center->Center_name}} , {{@$center->Center_address}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="state" value="{{$profileData->state}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="city" value="{{$profileData->city}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Pincode</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pincode" value="{{$profileData->pincode}}" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="address" value="{{$profileData->address}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="formButton">
                            <button type="submit" class="btn btn-primary mb-3">Update</button>
                        </div>
                    </form>
                </div>

                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Crop Image Before Upload</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img src="" id="profile_sample_image" style="width:100%;overflow: hidden;"/>
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


        </div>
    </section>
@endsection
@section('customJavascript')
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

        $profileModal.on('shown.bs.modal', function () {
            profileCropper = new Cropper(profileImage, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview',
                setDragMode: 'move'
            });
        }).on('hidden.bs.modal', function () {
            profileCropper.destroy();
            profileCropper = null;
        });

        $('#crop').click(function () {
            cover_canvas = profileCropper.getCroppedCanvas({
                width: 600,
                height: 600
            });

            cover_canvas.toBlob(function (blob) {
                file = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);

                var inputPreviewBox = document.getElementById('profile_picture_image');
                reader.onloadend = function () {
                    var base64data = reader.result;
                    var formData = new FormData();
                    let url = "{{action('WebFrontend\DashboardController@profileImage')}}";
                    formData.append('profile_picture', base64data);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data:formData,
                        cache:false,
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,
                        dataType: 'JSON',
                        xhr: function () {
                            $("#progress").show();
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded / evt.total) * 100;
                                    var percentValue = percentComplete + '%';
                                    $("#progressBar").css('width', '' + percentValue + '');
                                }
                            }, false);
                            return xhr;
                        },
                        complete: function (xhr) {
                            if (xhr.responseText && xhr.responseText != "error") {
                                $profileModal.modal('hide');
                                $("#progress").hide();
                                inputPreviewBox.src = xhr.responseText;
                                $('#profile_image_header').attr('src',xhr.responseText);

                            } else {
                                $profileModal.modal('hide');
                                $("#progressBar").stop();
                                $("#progress").stop();
                                $("#progress").hide();

                                swal("OOPs, Something is wrong!", 'Problem in uploading file', "error");
                            }
                        }
                    });
                };

            });
        });
</script>
@endsection
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
    
    <section class="chatBg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @if(@$reply)
                    <div class="chatMain" id="chatMain">
                        <div class="chatBase" id="chatBase">
                            @foreach ($reply as $replys)
                                @if($replys->help_type == 2)
                                    <div class="chatLft">
                                        <div class="chatTxt">
                                            <p>Admin, <span>{{date('d-M-Y',strtotime($replys->created_at))}}</span></p>
                                            <ul>
                                                <li>{{strip_tags($replys->message)}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="chatRgt">
                                        <div class="chatTxt">
                                            <p><span>{{date('d-M-Y',strtotime($replys->created_at))}}</span> {{Auth::user()->name}}</p>
                                            <ul>
                                                <li>{{$replys->message}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif  
                </div>
                <div class="col-md-6">
                    <div class="chatForm">
                        <h3>Contact Us:</h3>
                        <form class="form contactfrom"  method="post" action="{{ route('save-help') }}" id="helpForm">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control"  id="subject" name="subject" placeholder="Subject">
                                <span class="form-text text-danger"
                                                      id="error_subject">{{ $errors->getBag('default')->first('subject') }}</span>
                            </div>
                            <div class="mb-3">
                                <textarea   id="message" name="message" class="form-control" placeholder="Enter your Message" cols="30" rows="10"></textarea>
                                <span class="form-text text-danger"
                                                      id="error_message">{{ $errors->getBag('default')->first('message') }}</span>
                            </div>

                            <button type="submit" class="btn signup">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJavascript')
<script>
//scroll down
var element = document.getElementById("chatBase");
element.scrollTop = element.scrollHeight;

$('#helpForm').validate({
        rules: {

            subject: {
                required: true
            },
            message: {
                required: true
            }

        },
        messages: {

            subject: {
                required: "This subject field is required."
            },
            message: {
                required: "This message field is required."

            }
        },
        errorElement: "span",
        errorClass: "form-text text-danger is-invalid"
    });
    $('#helpForm').submit(function () {
            $('button[type=submit]').attr("disabled", true);
            setTimeout(function () {
                $('button[type=submit]').attr("disabled", false);
            }, 3000);
        });
</script>
@endsection
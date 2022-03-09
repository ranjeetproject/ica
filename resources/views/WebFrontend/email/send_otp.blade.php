<!DOCTYPE html>
<html>
<head>
    <title>Your Otp</title>

</head>
<body>
<table height="100%" cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#ffffff">
    <tbody>
    <tr>
        <td valign="top" align="center" height="100%" width="100%">
            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                   style="max-width:620px; border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-top: 1px solid #dddddd;">
                <tbody>
                <tr>
                    <td>
                        <a href="#" target="_blank"
                           style="display:inline-block; width:100%; text-align: center;float:left;"><img
                                src="{{asset('css/images/logo.svg')}}" width="618px" alt="" style="float: left"/></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" align="center" height="100%" width="100%">
            <table cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" border="0" width="100%"
                   style="max-width:620px; border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
                <tbody>
                <tr>
                    <td align="center" style="padding:20px 20px 40px 20px;font-size:16px;line-height:22px">
                        <h3>Hello!</h3>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding:20px 20px 40px 20px;font-size:16px;line-height:22px">
                        <p>
                            Your One Time Password (OTP) is {{$otp}}.Please enter this code on the ICA App to verify your mobile number. NEVER SHARE YOUR OTP WITH ANYONE.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding:20px 20px 40px 20px;font-size:16px;line-height:22px">
                        {{-- <p>Please click the link </p>
                        <a href="{{action('RecruitmentController@interviewFeedback', $row->id)}}" class="btn btn-primary">Interviewer Feedback</a> --}}
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding:20px 20px 40px 20px;font-size:16px;line-height:22px">
                        {{-- <p>If you did not request a password reset, no further action is required</p>  --}}
                        <br/><p>
                        Regards,
                        ICA</p>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="padding:20px 20px 40px 20px;font-size:16px;line-height:22px">
                        <p>
                            <h6>
                                <p>
                                    {{-- If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: --}}
                                    {{-- {{URL::to('/').'/reset-password-form?email='.$user->email.'&token='.$user->remember_token}} --}}
                                </p>
                            </h6>
                        </p>
                    </td>
                </tr>
                <tr>
                    {{-- <td align="center" bgcolor="#1e1e2d" style="padding-top: 30px; padding-bottom: 0px;">
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s1.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s2.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s3.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s4.png')}}" width="" alt=""/></a>
                        <a href="#" style="display: inline-block; margin: 0 5px;" target="_blank"><img
                                src="{{asset('images/s5.png')}}" width="" alt=""/></a>
                    </td> --}}
                </tr>
                <tr>
                    <td align="center" bgcolor="#1e1e2d" style="padding-top: 20px; padding-bottom: 20px;">
                        <span
                            style="color:#717070;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,sans-serif;font-size:12px;line-height:18px">&copy; {{date('Y')-1}} - {{date('Y')}} ICA
                            All Rights Reserved</span><br>
                        <span
                            style="color:#717070;font-style:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;text-align:-webkit-left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;font-family:Arial,sans-serif;font-size:12px;line-height:18px">URL: <a
                                href="{{asset('/')}}" style="color:#cccccc;">www.ica.com</a>; Email: <a
                                href="mailto:ica@gmail.com"
                                style="color:#cccccc;">ica@gmail.com</a></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>

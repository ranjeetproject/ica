<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use Mail;


class UserController extends Controller
{
    public function signUp()
    {
        return view('WebFrontend.registration');
    }

    public function loginForm()
    {
        return view('WebFrontend.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'mobile_number' => 'required',
            'verify_Otp' => 'required',

        ]);
        $credentialsArray = [
            'code' => $request->get('code'),
            'mobile' => $request->get('mobile_number'),
            'otp' => $request->get('verify_Otp'),
            
            

        ];
        dd(Auth::attempt($credentialsArray));
        if (Auth::attempt($credentialsArray))
        {
            dd('ghj');

        } 
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'mobile_number' => 'required',
        ]);
        $input = $request->all();
        $check_student = Student::where('code','=',$input['code'])->where('mobile','=',$input['mobile_number'])->first();
        if(!empty($check_student)){
            $otp = rand(100000,999999);
            $update_student = Student::find($check_student->id);
            $update_student->otp = $otp;
            if($update_student->save()){
                $email_send = Mail::send('WebFrontend.email.send_otp',  
                    array(
                        'name'          => $check_student->name,
                        'email'         => $check_student->email,
                        'mobile'        => $check_student->mobile,
                        'otp'           => $otp
                    ), function($message) use ($check_student) {
                        $message->to($check_student->email, $check_student->name)->subject('OTP verification for Learnersmall App.');
                        $message->from('verification@icajobguarantee.com', 'ICA');
                });

                $text = "Your One Time Password (OTP) is ". $otp ." for the mobile number ". $check_student->mobile .". Please enter this code on the ICA App to verify your mobile number. NEVER SHARE YOUR OTP WITH ANYONE.";
                // Textlocal account details
                $username = urlencode('icaedpho');
                $password = urlencode('icaedpho');
                $to=urlencode($check_student->mobile);
                $from=urlencode('ICAEDU');
                $text=urlencode($text);
                
                //https://103.229.250.200/smpp/sendsms?username=icaedpho&password=icaedpho&to=9830190321&from=ICAEDU&udh=0&text=Your One Time Password (OTP) is 1234 for the mobile number 9830190321. Please enter this code on the ICA App to verify your mobile number. NEVER SHARE YOUR OTP WITH ANYONE.&dlr-mask=19&dlr-url=
                //https://myvaluefirst.com/smpp/sendsms?username=icaedpho&password=icaedpho&to=9681021465&from=ICAEDU&udh=0&text=Your One Time Password (OTP) is 1234 for the mobile number 9681021465. Please enter this code on the ICA App to verify your mobile number. NEVER SHARE YOUR OTP WITH ANYONE.
                // Prepare data for POST request
                $sms_data = 'username=' . $username . '&password=' . $password . '&to=' . $to . '&from=' . $from . '&udh=0&text=' . $text . '&dlr-mask=19&dlr-url=';
                // Send the GET request with cURL
                $ch = curl_init('https://103.229.250.200/smpp/sendsms?'.$sms_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                //echo $response;
                curl_close($ch);
                $data['status'] = true;
                $data['message'] = "Otp send successfully";
                return $data;
            }
        }else{
            $data['status'] = false;
            $data['error'] = "Please enter correct registered user id and mobile number";
            return $data;
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'mobile_number' => 'required',
            'verify_Otp' => 'required', 
        ]);
        $input = $request->all();
        $check_student = Student::where('code','=',$input['code'])->where('mobile','=',$input['mobile_number'])->first();
        if($check_student->otp == $input['verify_Otp'])
        {
            $data['status'] = true;
            $data['message'] = "Otp verify successfully";
            return $data;
        }else{
            $data['status'] = false;
            $data['message'] = "Please fill correct otp";
            return $data;
        }

    }
    

}
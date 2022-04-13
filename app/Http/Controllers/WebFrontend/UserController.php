<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\State;
use App\Course;
use App\StdCourse;
use App\Exam;
use App\StdExam;
use App\Events\CourseAssign;
use App\Events\ExamAssign;
use Illuminate\Support\Facades\Mail;
use Hash;


class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function signUp()
    {
        $states = State::get();
        return view('WebFrontend.registration',compact('states'));
    }

    public function loginForm()
    {
        return view('WebFrontend.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
           // 'mobile_number' => 'required',
            'verify_Otp' => 'required',
        ]);
        $input = $request->all();
        $checkStudentOtp = Student::where('code', '=', $input['code'])->where('otp', $input['verify_Otp'])->first();
        if ($checkStudentOtp)
        {
            Auth::login($checkStudentOtp);
            if (Auth::check())
            {
                // $this->defaultCourse(Auth::user()->id);
                event(new CourseAssign());
                // $this->defaultExam(Auth::user()->id);
                event(new ExamAssign());
                $student=Student::find($checkStudentOtp->id);
                if($student)
                {
                    $student->otp=rand(100000, 999999);
                    $student->save();
                }
                return redirect()->action('WebFrontend\DashboardController@dashboardPageDisplay');
            }
        }else{
            return redirect()->back()->with(['error'=>'Oops! You have entered invalid code or otp']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->action('WebFrontend\UserController@loginForm');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'code' => 'required',
           // 'mobile_number' => 'required',
        ]);
        $input = $request->all();
        $check_student = Student::where('code', '=', $input['code'])->first();
        if (!empty($check_student)) {
            $otp = rand(100000, 999999);
            $update_student = Student::find($check_student->id);
            $update_student->otp = $otp;
            if ($update_student->save()) {
                $email_send = Mail::send('WebFrontend.email.send_otp',
                    array(
                        'name' => $check_student->name,
                        'email' => $check_student->email,
                        'mobile' => $check_student->mobile,
                        'otp' => $otp
                    ), function ($message) use ($check_student) {
                        $message->to($check_student->email, $check_student->name)->subject('OTP verification for Learnersmall App.');
                        $message->from('verification@icajobguarantee.com', 'ICA');
                    });

                $text = "Your One Time Password (OTP) is " . $otp . " for the mobile number " . $check_student->mobile . ". Please enter this code on the ICA App to verify your mobile number. NEVER SHARE YOUR OTP WITH ANYONE.";
                // Textlocal account details
                $username = urlencode('icaedpho');
                $password = urlencode('icaedpho');
                $to = urlencode($check_student->mobile);
                $from = urlencode('ICAEDU');
                $text = urlencode($text);

                // Prepare data for POST request
                $sms_data = 'username=' . $username . '&password=' . $password . '&to=' . $to . '&from=' . $from . '&udh=0&text=' . $text . '&dlr-mask=19&dlr-url=';
                // Send the GET request with cURL
                $ch = curl_init('https://103.229.250.200/smpp/sendsms?' . $sms_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $data['status'] = true;
                $data['message'] = "OTP is sent to your email";
                return $data;
            }
        } else {
            $data['status'] = false;
            $data['error'] = "Please enter correct your code";
            return $data;
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'code' => 'required',
            //'mobile_number' => 'required',
            'verify_Otp' => 'required',
        ]);
        $input = $request->all();
        $checkStudentOtp = Student::where('code', '=', $input['code'])->where('otp', $input['verify_Otp'])->count();
        if ($checkStudentOtp > 0) {
            $data['status'] = true;
            $data['message'] = "Otp verify successfully";
            return $data;
        } else {
            $data['status'] = false;
            $data['message'] = "Please fill correct otp";
            return $data;
        }

    }

    public function registration(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|integer',
            'mobile' => 'required|unique:students'
        ], [
            'name.required' => 'Name is required',
            'address' => 'Address is required',
            'pincode.integer' => 'Pin Code should be a number',
            'mobile' => 'Mobile No is required'
        ]);
        $otp = rand(100000,999999);
        $studentRegistration = Student::create([
            'code' => $request->mobile,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'status' => 1,
            'otp' => $otp,
            'verify_status' => 0,
        ]);

        $inputData = [];
        $inputData['email'] = $request->email;
        $inputData['name'] = $request->name;
        $inputData['mobile'] = $request->mobile;
        Mail::send('WebFrontend.email.registration_successful', ['data' => $inputData] , function ($m) use ($inputData) {
                $m->from('ica@gmail.com','ica');
                $m->to($inputData['email'],$inputData['name'])->subject('Registration Successful');
        });

        if($studentRegistration){
            \Session::put('success','You are registered successfully');
            return redirect()->back();
        }else{
            \Session::put('error','Failed! User not registered');
            return redirect()->back();
        }
    }

    public function checkEmailIsPresentOrNot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $input = $request->all();
        $present = $this->userRepository->checkEmailIsPresentOrNotRepo($input);
        if ($present) {
            $valid = 'false';
            echo $valid;
        } else {
            $valid = 'true';
            echo $valid;
        }
    }

    public function checkMobileIsPresentOrNot(Request $request)
    {
        $request->validate([
            'mobile' => 'required|integer',
        ]);
        $input = $request->all();
        $present = $this->userRepository->checkMobileNosPresentOrNotRepo($input);
        if ($present) {
            $valid = 'false';
            echo $valid;
        } else {
            $valid = 'true';
            echo $valid;
        }
    }

    public function defaultCourse($student_id)
    {
        $allcourses = Course::where('tagging_for', ':All:')->get();
        foreach ($allcourses as $allcourse) {
            $stdcourses1 = StdCourse::where('student', $student_id)->where('course', $allcourse->id)->count();
            if ($stdcourses1 == 0) {
                $db1 = new StdCourse();
                $db1->student = $student_id;
                $db1->course = $allcourse->id;
                $db1->save();
            }else{
                return $stdcourses1;
            }
        }
    }

    public function defaultExam($student_id)
    {
        $allexams = Exam::where('tagging_for', ':All:')->get();
        foreach ($allexams as $allexam) {
            $stdexam1 = StdExam::where('student', $student_id)->where('exam', $allexam->id)->count();
            if ($stdexam1 == 0) {
                $db1 = new StdExam();
                $db1->student = $student_id;
                $db1->exam = $allexam->id;
                $db1->save();
            }else{
                return $stdexam1;
            }
        }
    }

}
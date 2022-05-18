<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\State;
use App\Course;
use App\StdCourse;
use App\Exam;
use App\StdExam;
use App\centre;
use App\Events\CourseAssign;
use App\Events\ExamAssign;
use Illuminate\Support\Facades\Mail;
use Hash;
use App\Jobs\CoursesSetup;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function signUp()
    {
        $states = State::get();
        return view('WebFrontend.registration', compact('states'));
    }

    public function registration(Request $request)
    {
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
        $otp = rand(100000, 999999);
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
        Mail::send('WebFrontend.email.registration_successful', ['data' => $inputData], function ($m) use ($inputData) {
            $m->from('ica@gmail.com', 'ica');
            $m->to($inputData['email'], $inputData['name'])->subject('Registration Successful');
        });

        if ($studentRegistration) {
            \Session::put('success', 'Congratulation. You have successfully registered with us. Your User Code is ' . $request->mobile . '.');
            return redirect()->back();
        } else {
            \Session::put('error', 'Failed! User not registered');
            return redirect()->back();
        }
    }

    public function checkEmailIsPresentOrNot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $input = $request->all();
        $present = $this->checkEmailIsPresentOrNotRepo($input);
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
        $present = $this->checkMobileNosPresentOrNotRepo($input);
        if ($present) {
            $valid = 'false';
            echo $valid;
        } else {
            $valid = 'true';
            echo $valid;
        }
    }

    public function checkEmailIsPresentOrNotRepo($inputData)
    {
        if (isset($inputData['email'])) {
            $user = Student::where('email', $inputData['email'])->first();
            if ($user) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkMobileNosPresentOrNotRepo($inputData)
    {
        if (isset($inputData['mobile'])) {
            $user = Student::where('mobile', $inputData['mobile'])->first();
            if ($user) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }




    public function loginForm()
    {
        return view('WebFrontend.login');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
        $input = $request->all();
        $check_student = Student::where('code', '=', $input['code'])->first();
        if (!empty($check_student)) {
            $otp = rand(100000, 999999);
            $update_student = Student::find($check_student->id);
            $update_student->otp = $otp;
            if ($update_student->save()) {
                Mail::send('WebFrontend.email.send_otp',
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
                $username = urlencode('icaedpho');
                $password = urlencode('icaedpho');
                $to = urlencode($check_student->mobile);
                $from = urlencode('ICAEDU');
                $text = urlencode($text);

                // Prepare data for POST request
                $sms_data = 'username=' . $username . '&password=' . $password . '&to=' . $to . '&from=' . $from . '&udh=0&text=' . $text . '&dlr-mask=19&dlr-url=';
                $ch = curl_init('https://103.229.250.200/smpp/sendsms?' . $sms_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $data['status'] = true;
                $data['message'] = "OTP sent to E-mail ID";
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

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'verify_Otp' => 'required',
        ]);
        $input = $request->all();
        $checkStudentOtp = Student::where('code', '=', $input['code'])->where('otp', $input['verify_Otp'])->first();
        if ($checkStudentOtp) {
            Auth::login($checkStudentOtp);
            if (Auth::check()) {
                $student = Student::find($checkStudentOtp->id);
                if ($student) {
                    $student->otp = rand(100000, 999999);
                    $student->save();

                    // Log::debug('Start Writing in controller'); 
                    // CoursesSetup::dispatch();
                    // Log::debug('End Writing in controller'); 
                   // event(new CourseAssign());
                    //event(new ExamAssign());
                }
                return redirect()->action('WebFrontend\DashboardController@dashboardPageDisplay',['afterLogin'=>1]);
            }
        } else {
            return redirect()->back()->with(['error' => 'Oops! You have entered invalid code or otp']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->action('WebFrontend\UserController@loginForm');
    }




    public function courseTagging()
    {
        //All Courses
        $allCourses = Course::where('tagging_for', ':All:')->get();
        foreach ($allCourses as $allCourse) {
            $stdCourses = StdCourse::where('student', Auth::user()->id)
                ->where('course', $allCourse->id)->count();
            if ($stdCourses == 0) {
                $stdCourse = new StdCourse();
                $stdCourse->student = Auth::user()->id;
                $stdCourse->course = $allCourse->id;
                $stdCourse->save();
            }
        }

        //Centre Courses
        $centerLike = "";
        $centres = centre::where('Center_code', Auth::user()->centre_code)->first();
        if ($centres != '') {
            $centerLike = ":CE" . $centres->id . ":";
            $centerCourses = Course::where('tagging_for', 'like', '%:Centre:%')
                ->where('tagging_text', 'like', '%' . $centerLike . '%')->get();
            foreach ($centerCourses as $centerCourse) {
                $stdCourses2 = StdCourse::where('student', Auth::user()->id)->where('course', $centerCourse->id)->count();
                if ($stdCourses2 == 0) {
                    $stdCourse = new StdCourse();
                    $stdCourse->student = Auth::user()->id;
                    $stdCourse->course = $centerCourse->id;
                    $stdCourse->save();
                }
            }
        }

        //Tutor Course
        $tutorLike = ":TU" . Auth::user()->created_by . ":";
        $tutorCourses = Course::where('tagging_for', 'like', '%:Tutor:%')->where('tagging_text', 'like', '%' . $tutorLike . '%')->get();
        foreach ($tutorCourses as $tutorCourse) {
            $stdCourses3 = StdCourse::where('student', Auth::user()->id)->where('course', $tutorCourse->id)->count();
            if ($stdCourses3 == 0) {
                $stdCourse = new StdCourse();
                $stdCourse->student = Auth::user()->id;
                $stdCourse->course = $tutorCourse->id;
                $stdCourse->save();
            }
        }

        //Batch Course
        $batchLike = ":BA" . Auth::user()->batch_id . ":";
        $batchCourses = Course::where('tagging_for', 'like', '%:Batch:%')->where('tagging_text', 'like', '%' . $batchLike . '%')->get();
        foreach ($batchCourses as $batchCourse) {
            $stdCourses3 = StdCourse::where('student', Auth::user()->id)->where('course', $batchCourse->id)->count();
            if ($stdCourses3 == 0) {
                $stdCourse = new StdCourse();
                $stdCourse->student = Auth::user()->id;
                $stdCourse->course = $batchCourse->id;
                $stdCourse->save();
            }
        }
    }

    public function examTagging()
    {
        //All Exam
        $allExams = Exam::where('tagging_for', ':All:')->get();
        foreach ($allExams as $allExam) {
            $stdExam1 = StdExam::where('student', Auth::user()->id)->where('exam', $allExam->id)->count();
            if ($stdExam1 == 0) {
                $stdExam = new StdExam();
                $stdExam->student = Auth::user()->id;
                $stdExam->exam = $allExam->id;
                $stdExam->save();
            }
        }

        //Centre Exam
        $centerLike = "";
        if (Auth::user()->centre_code != null) {
            $centres = centre::where('Center_code', Auth::user()->centre_code)->first();
            if ($centres != '') {
                $centerLike = ":CE" . $centres->id . ":";
                if ($centerLike != '') {
                    $centerExams = Exam::where('tagging_for', 'like', '%:Centre:%')->where('tagging_text', 'like', '%' . $centerLike . '%')->get();
                    foreach ($centerExams as $centerExam) {
                        $stdExam2 = StdExam::where('student', Auth::user()->id)->where('exam', $centerExam->id)->count();
                        if ($stdExam2 == 0) {
                            $stdExam = new StdExam();
                            $stdExam->student = Auth::user()->id;
                            $stdExam->exam = $centerExam->id;
                            $stdExam->save();
                        }
                    }
                }
            }
        }

        //Tutor Exam
        $tutorLike = ":TU" . Auth::user()->created_by . ":";
        if ($tutorLike != '') {
            $tutorExams = Exam::where('tagging_for', 'like', '%:Tutor:%')->where('tagging_text', 'like', '%' . $tutorLike . '%')->get();
            foreach ($tutorExams as $tutorExam) {
                $stdExam3 = StdExam::where('student', Auth::user()->id)->where('exam', $tutorExam->id)->count();
                if ($stdExam3 == 0) {
                    $stdExam = new StdExam();
                    $stdExam->student = Auth::user()->id;
                    $stdExam->exam = $tutorExam->id;
                    $stdExam->save();
                }
            }
        }

        //Batch Exam
        $batchLike = ":BA" . Auth::user()->batch_id . ":";
        if ($batchLike != '') {
            $batchExams = Exam::where('tagging_for', 'like', '%:Batch:%')->where('tagging_text', 'like', '%' . $batchLike . '%')->get();
            foreach ($batchExams as $batchExam) {
                $stdExam3 = StdExam::where('student', Auth::user()->id)->where('exam', $batchExam->id)->count();
                if ($stdExam3 == 0) {
                    $stdExam = new StdExam();
                    $stdExam->student = Auth::user()->id;
                    $stdExam->exam = $batchExam->id;
                    $stdExam->save();
                }
            }
        }

    }

    public function erpCourseTagging()
    {
        $url = 'https://new.icaerp.com/api/Data/searchstudent';
        $data_string = '{"StudentCode": "' . Auth::user()->code . '" }';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if (array_key_exists("StudentCode", $result)) {
            if ($result['courses'] != '') {
                $courses = $result['courses'];
                foreach ($courses as $val) {
                    $course1 = Course::where('course_code', $val['courseid'])->first();
                    if ($course1) {
                        $courseLike = ":CO" . $course1->id . ":";
                        $c_courses = Course::where('tagging_for', 'like', '%:Course:%')->where('tagging_text', 'like', '%' . $courseLike . '%')->get();
                        foreach ($c_courses as $c_course) {
                            $stdCourses4 = StdCourse::where('student', Auth::user()->id)->where('course', $c_course->id)->count();
                            if ($stdCourses4 == 0) {
                                $stdCourse = new StdCourse();
                                $stdCourse->student = Auth::user()->id;
                                $stdCourse->course = $c_course->id;
                                $stdCourse->save();
                            }
                        }
                    }
                }
            }

            if ($result['courses'] != '') {
                $courses = $result['courses'];
                foreach ($courses as $val) {
                    $course1 = Course::where('course_code', $val['courseid'])->first();
                    if ($course1) {
                        $courseLike = ":CO" . $course1->id . ":";
                        $c_courses = Exam::where('tagging_for', 'like', '%:Course:%')->where('tagging_text', 'like', '%' . $courseLike . '%')->get();
                        foreach ($c_courses as $c_course) {
                            $stdCourses4 = StdExam::where('student', Auth::user()->id)->where('exam', $c_course->id)->count();
                            if ($stdCourses4 == 0) {
                                $stdExam = new StdExam();
                                $stdExam->student = Auth::user()->id;
                                $stdExam->exam = $c_course->id;
                                $stdExam->save();
                            }
                        }
                    }
                }
            }

        }
    }

    /*public function courseSave($request, $student_id) {
        $courses = $request['courses'];
        foreach($courses as $val) {
            $db_course = new StudentCourse();
            $db_course->student_id = $student_id;
            $db_course->course_code = $val['courseid'];
            $db_course->course_name = $val['coursename'];
            $db_course->admission_date = stripslashes($val['admission']);
            $db_course->save();
        }
        return true;
    }*/

    public function courseExamEvent()
    {
        event(new CourseAssign());
        event(new ExamAssign());
    }


}
<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use App\Course;
use App\centre;
use App\Exam;
use App\Question;
use App\StdCourse;
use App\Cms;
use App\Student;
use App\Batch;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\CourseAssign;
use App\Events\ExamAssign;

class DashboardController extends Controller
{
    public function dashboardPageDisplay(Request $request)
    {
        
	    $dashboardCms=Cms::find(5);
        // $courses = Course::join('std_courses','std_courses.course','=','courses.id')
        //     ->where('courses.entry_from','NEW')
        //     ->where('std_courses.student', Auth::user()->id)->limit(3)
        //     ->get();
        
        // $exams=[];
        // $examsData = Exam::select('exams.id as ex_id','std_exam.id as std_exam_id','exams.exam_code','exams.exam_name',
        // 'exams.exam_details','exams.course','exams.centre','exams.chapter','exams.subject','exams.type','exams.exam_zone','exams.exam_for','exams.duration')
        // ->join('std_exam','std_exam.exam','=','exams.id')
        // ->where('std_exam.student','=', Auth::user()->id)
        // ->where('exams.exam_for','=',1)->where('exams.status','=',1)->get();
        // $i=0;
        // foreach ($examsData as $value_ex) 
        // {
        //     $question = Question::where('exam_id', $value_ex->ex_id)->where('state', '1')->count();
        //     if ($question > 0) 
        //     {     
        //         if($i<=3)
        //         {
        //             $exams[] = $value_ex;
        //         }
        //         $i++;
        //     }            
        // }
        //return $exams;
        $afterLogin=0;
        if($request->has('afterLogin'))
        {
            $afterLogin=$request->get('afterLogin');
        }
        return view('WebFrontend.dashboard.dashboard',compact('dashboardCms','afterLogin'));
    }


    public function dashboardCourseDisplay(Request $request)
    {
        if($request->ajax())
        {
            if($request->has('type'))
            {
                if($request->get('type')==1)
                {
                    event(new CourseAssign());                    
                }
            }
            $courses = Course::join('std_courses','std_courses.course','=','courses.id')
                        ->where('courses.entry_from','NEW')
                        ->where('std_courses.student', Auth::user()->id)->limit(3)
                        ->get();

            $view = view('WebFrontend.dashboard.dashboard_courses',compact('courses'))->render();
            return response()->json(['html' => $view]);
        }
        else{
            return abort('404');
        }
    }

    public function dashboardExamDisplay(Request $request)
    {
        if($request->ajax())
        {
            if($request->has('type'))
            {
                if($request->get('type')==1)
                {
                    event(new ExamAssign());
                }
            }

            $exams=[];
            $examsData = Exam::select('exams.id as ex_id','std_exam.id as std_exam_id','exams.exam_code','exams.exam_name',
            'exams.exam_details','exams.course','exams.centre','exams.chapter','exams.subject','exams.type','exams.exam_zone','exams.exam_for','exams.duration','exams.exam_image')
            ->join('std_exam','std_exam.exam','=','exams.id')
            ->where('std_exam.student','=', Auth::user()->id)
            ->where('exams.exam_for','=',1)->where('exams.status','=',1)->get();
            $i=0;
            foreach ($examsData as $value_ex) 
            {
                $question = Question::where('exam_id', $value_ex->ex_id)->where('state', '1')->count();
                if ($question > 0) 
                {     
                    if($i<=3)
                    {
                        $exams[] = $value_ex;
                    }
                    $i++;
                }                
            }
            $view = view('WebFrontend.dashboard.dashboard_exams',compact('exams'))->render();
            return response()->json(['html' => $view]);
        }
        else{
            return abort('404');
        }
    }

    
    public function profileImage(Request $request)
    {
        $input = [];
        if ($request->has('profile_picture')) {
            $file = $request->get('profile_picture');
            $image_array_1 = explode(";", $file);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $rand_val = date('YMDHIS') . rand(11111, 99999);
            $image_name = md5($rand_val);
            $fileName = $image_name . '.jpg';

            $destinationPath = public_path() . '/user_images/' . $fileName;
            //$destinationPath = 'https://learnersmall.in/android/public/profile_photo/' . $fileName;

            file_put_contents($destinationPath, $data);
            $input['profile_image'] = asset('user_images/')."/".$fileName;
            $this->imageUpload($input);
            return $input['profile_image'];

        }

    }

    public function imageUpload($inputData)
    {
        if(Auth::check())
        {
            $id=Auth::user()->id;
            $user=Student::find($id);
            if($user)
            {
                $user->update($inputData);
                return ['success'=>true];
            }
            else{
                return ['success'=>false];
            }
        }
        else{
            return ['success'=>false];
        }

    }

    public function profilePage()
    {
        $batch = Batch::where('id',Auth::user()->batch_id)->get();
        $center = centre::where('Center_code',Auth::user()->centre_code)->first();
        $courses = Course::join('std_courses','std_courses.course','=','courses.id')
            ->where('courses.entry_from','NEW')
            ->where('std_courses.student', Auth::user()->id)
            ->get();


        $studentCode='"'.Auth::user()->code.'"';
        $postFields='{
            "StudentCode":'.$studentCode.'
        }';
        $data=[];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://new.icaerp.com/api/Data/searchstudent',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$postFields,
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $apiData=json_decode($response,true);    
        return view('WebFrontend.profile',compact('courses','batch','center','apiData'));
    }

    public function editProfilePage($id)
    {
        $profileData = Student::find($id);
        $center = centre::where('Center_code',$profileData->centre_code)->first();
        if($profileData){
            return view('WebFrontend.edit-profile',compact('profileData','center'));
        }else{
            abort('404');
        }
    }

    public function updateProfilePage(Request $request,$id)
    {
        $row = Student::find($id);
        $request->validate([
            'mobile' => 'required|digits:10|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|numeric|min:6',
        ]);
        $inputData = $request->all();
        if ($row) {
            $row->update($inputData);
            Session::put('success', 'Your Profile Update Successfully');
            return redirect()->action('WebFrontend\DashboardController@profilePage');
            
        } else {
            Session::put('error', 'Failed!');
            return redirect()->back();
        }
    }

    

}
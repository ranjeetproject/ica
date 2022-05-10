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

class DashboardController extends Controller
{
    public function dashboardPageDisplay()
    {
	    $dashboardCms=Cms::find(5);
        $courses = Course::join('std_courses','std_courses.course','=','courses.id')
            ->where('courses.entry_from','NEW')
            ->where('std_courses.student', Auth::user()->id)->limit(3)
            ->get();
        
        $exams=[];
        $examsData = Exam::select('exams.id as ex_id','std_exam.id as std_exam_id','exams.exam_code','exams.exam_name',
        'exams.exam_details','exams.course','exams.centre','exams.chapter','exams.subject','exams.type','exams.exam_zone','exams.exam_for','exams.duration')
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
        return view('WebFrontend.dashboard',compact('courses','exams','dashboardCms'));
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
            $input['profile_image'] = $fileName;
            $this->imageUpload($input);
            return asset('user_images/' . $fileName);

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
        return view('WebFrontend.profile',compact('courses','batch','center'));
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
        $inputData = $request->all();
        //dd($inputData);
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
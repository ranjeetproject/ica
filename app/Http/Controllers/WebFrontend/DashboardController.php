<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use App\Course;
use App\Exam;
use App\Question;
use App\StdCourse;
use App\Cms;
use App\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardPageDisplay()
    {

        // return $this->courseTagging(Auth::user()->id); 
	    $dashboardCms=Cms::find(5);
        $courses = Course::join('std_courses','std_courses.course','=','courses.id')
            ->where('courses.entry_from','NEW')
            ->where('std_courses.student', Auth::user()->id)
            ->get();
        // // $courses = Course::where('created_by',1)->orderBy('created_at','DESC')->limit(3)->get();
        // //$exams = Exam::with('courseDetails')->where('created_by',1)->orderBy('created_at','DESC')->limit(3)->get();
        $exams = Exam::join('std_exam','std_exam.exam','=','exams.id')
        ->where('std_exam.student','=', Auth::user()->id)
        ->where('exams.exam_for','=',1)->where('exams.status','=',1)->get();
        if(count($exams)>0){
            foreach ($exams as $value_ex) 
            {
                $question = Question::where('exam_id', $value_ex->id)->where('state', '1')->get()->count();
                if ($question > 0) {
                    array_push($exams,$value_ex);
                }
            }
        }
        return view('WebFrontend.dashboard',compact('courses','exams','dashboardCms'));
    }

    public function courseTagging($student_id)
    {
        $student = Student::where('id', $student_id)->first();
       
        // echo $db[0]->code;
        
        //Searching for ICA ERP
        //Learnersmall Course
        $url = 'https://new.icaerp.com/api/Data/searchstudent';
        $data_string = '{"StudentCode": '.$student->code.' }';
        $data_strings = new \stdClass();
        $data_strings->StudentCode = $student->code;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_strings);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result,true);
        return $result;
        if (array_key_exists("StudentCode",$result)) {
            if ($result['courses']!='') {
                $courses = $result['courses'];
                foreach($courses as $val) {
                    // echo $val['courseid']."<br>";
                    $course1 = Course::where('course_code',$val['courseid'])->get();
                    if (count($course1)>0) {
                        $courselike = ":CO". $course1[0]->id .":";
                        $ccourses = Course::where('tagging_for', 'like', '%:Course:%')->where('tagging_text', 'like', '%'. $courselike .'%')->get();
                        foreach ($ccourses as $ccourse) {
                            $stdcourses4 = StdCourse::where('student', $student_id)->where('course', $ccourse->id)->count();
                            if ($stdcourses4 == 0) {
                                $db4 = new StdCourse();
                                $db4->student = $student_id;
                                $db4->course = $ccourse->id;
                                $db4->save();
                            }
                        }
                    }
                }
            }
        
            //Learnersmall Course
            if ($result['courses']!='') {
                $courses = $result['courses'];
                foreach($courses as $val) {
                    $course1 = Course::where('course_code',$val['courseid'])->get();
                    if (count($course1)>0) {
                        $courselike = ":CO". $course1[0]->id .":";
                        $ccourses = Exam::where('tagging_for', 'like', '%:Course:%')->where('tagging_text', 'like', '%'. $courselike .'%')->get();
                        foreach ($ccourses as $ccourse) {
                            $stdcourses4 = StdExam::where('student', $student_id)->where('exam', $ccourse->id)->count();
                            if ($stdcourses4 == 0) {
                                $db4 = new StdExam();
                                $db4->student = $student_id;
                                $db4->exam = $ccourse->id;
                                $db4->save();
                            }
                        }
                    }
                }
            }    
        }

    }
}
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

}
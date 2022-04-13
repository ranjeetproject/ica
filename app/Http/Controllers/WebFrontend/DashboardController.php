<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use App\Course;
use App\Exam;
use App\Question;
use App\StdCourse;
use App\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardPageDisplay()
    {
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
}
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
        $url = 'https://new.icaerp.com/api/Data/searchstudent';
        $data_string = '{"StudentCode": "'.Auth::user()->code.'" }';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result,true);
        // print_r($result);
        $courses = Course::join('std_courses','std_courses.course','=','courses.id')
            ->where('courses.entry_from','NEW')
            ->where('std_courses.student', Auth::user()->id)
            ->get();
        // // $courses = Course::where('created_by',1)->orderBy('created_at','DESC')->limit(3)->get();
        // //$exams = Exam::with('courseDetails')->where('created_by',1)->orderBy('created_at','DESC')->limit(3)->get();
        $exams = Exam::leftJoin('std_exam','std_exam.exam','=','exams.id')
        ->where('std_exam.student','=', Auth::user()->id)
        ->where('exams.exam_for','=',1)->where('exams.status','=',1)->get();
        
        return view('WebFrontend.dashboard',compact('courses','exams','dashboardCms'));
           
        
        
    }
}
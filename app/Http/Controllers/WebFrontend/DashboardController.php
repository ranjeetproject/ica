<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use App\Course;
use App\Exam;
use App\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardPageDisplay()
    {
	$dashboardCms=Cms::find(5);
        $courses = Course::where('created_by',1)->orderBy('created_at','DESC')->limit(3)->get();
        $exams = Exam::with('courseDetails')->where('created_by',1)->orderBy('created_at','DESC')->limit(3)->get();
        return view('WebFrontend.dashboard',compact('courses','exams','dashboardCms'));
    }
}

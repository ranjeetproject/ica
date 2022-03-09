<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;


class CourseController extends Controller
{
   
    public function myCourses(Request $request)
    {
        $data = Course::orderBy('id', 'DESC')->paginate(8);
        if($request->ajax()){
            $view = view('WebFrontend.all-course',compact('data'))->render();
            return response()->json(['html' => $view]);
        }
        return view('WebFrontend.myCourse',compact('data'));
    }

    public function courseDetail($id)
    {
        $courseDetails = Course::find($id);
        //dd($courseDetails);
        return view('WebFrontend.courseDetails',compact('courseDetails'));
    }
}
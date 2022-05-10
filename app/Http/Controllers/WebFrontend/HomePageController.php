<?php

namespace App\Http\Controllers\WebFrontend;

use App\Course;
use App\Http\Controllers\Controller;
use App\StdCourse;
use App\Cms;
use App\Testimonial;
use Illuminate\Http\Request;


class HomePageController extends Controller
{
    /**
     * query for display course without login
     */
    public function homePageDisplay(Request $request)
    {	    
        $course = Course::with('user')->whereHas('user')->with('lessons')->where('entry_from', 'NEW')->orderBy('created_at', 'DESC')->get(); 
        $data = [];
        foreach ($course as $value)
        {
            $stdcors = StdCourse::where('course', $value->id)->count();
            if ($stdcors > 1) {
                $value->status = 1;
                $value->stdCount = $stdcors;
            } else {
                $value->status = $stdcors;
                $value->stdCount = $stdcors;
            }
        }
        $data['courses'] = $course;
        $data['homeCms'] = Cms::find(6);
        $data['testimonial']=Testimonial::all();

        return view('WebFrontend.home', $data);
    }

    public function allCourses(Request $request)
    {	
        $data = []; 
        $data = Course::with('user')->whereHas('user')->with('lessons')->where('entry_from', 'NEW')->orderBy('created_at', 'DESC')->paginate(8);
        if($request->ajax()){
            $view = view('WebFrontend.all_courses_pagination',compact('data'))->render();
            return response()->json(['html' => $view]);
        }
        return view('WebFrontend.all_courses',compact('data'));
    }
}
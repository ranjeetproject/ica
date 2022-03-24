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


}

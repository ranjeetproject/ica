<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\StdCourse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (isset($request->admin) && ($request->admin != '')) $course  = Course::with('user')->whereHas('user')->with('lessons')->where('created_by', $request->admin)->where('entry_from','NEW')->orderBy('created_at','DESC')->get();
        else $course  = Course::with('user')->whereHas('user')->with('lessons')->where('entry_from','NEW')->orderBy('created_at','DESC')->get();
        $data = [];
        foreach ($course as $value) {
            // $stdcors = StdCourse::where('student', $request->student)->where('course', $value->id)->count();
            $stdcors = StdCourse::where('course', $value->id)->count();
            if ($stdcors > 1){ 
                $value->status = 1; 
                $value->stdCount = $stdcors; 
            }
            else{ 
                $value->status = $stdcors; 
                $value->stdCount = $stdcors;
            }
            // array_push($data_Course, $value);
        }
        $data['courses'] = $course;
        return view('WebFrontend.home',compact('data'));
    }
}
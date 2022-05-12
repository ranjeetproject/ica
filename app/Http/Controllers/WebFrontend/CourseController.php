<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Chapter;
use App\ChapterDetail;
use Illuminate\Support\Facades\Auth;





class CourseController extends Controller
{

    public function myCourses(Request $request)
    {
        $data = [];
        $data = Course::join('std_courses','std_courses.course','=','courses.id')
            ->where('courses.entry_from','NEW')
            ->where('std_courses.student', Auth::user()->id)
            ->paginate(8);

        // return $data;
        if($request->ajax()){
            $view = view('WebFrontend.all-course',compact('data'))->render();
            return response()->json(['html' => $view]);
        }
        return view('WebFrontend.myCourse',compact('data'));
    }

    public function courseDetail($id)
    {
        $topics = [];
        $course = Course::find($id);
        if($course){
            $courseChapter = Chapter::where('course_id','=',$course->id)->get();
            foreach($courseChapter as $chapter)
            {
                $chapter->topicsCount = ChapterDetail::where('course','=',$course->id)
                    ->where('chapter','=',$chapter->id)->count();
            }
            $course->courseChapter=$courseChapter;
            return view('WebFrontend.courseDetails',compact('course'));
        }
        else
        {
            abort('404');
        }

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
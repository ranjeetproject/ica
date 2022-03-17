<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Chapter;
use App\ChapterDetail;
use App\StdCourse;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Auth;





class CourseController extends Controller
{

    public function myCourses(Request $request)
    {
        $data = [];
        $data = Course::join('std_courses','std_courses.course','=','courses.id')
<<<<<<< HEAD
                   ->where('courses.entry_from','NEW')                   
                   ->where('std_courses.student', Auth::user()->id)
                   ->paginate(8); 
                   
=======
                   ->where('courses.entry_from','NEW')
                   ->where('std_courses.student', Auth::user()->id)
                   ->paginate(8);

>>>>>>> 6e9f86a94b7e4768789f6b1f24bec6ee94a1906e
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
<<<<<<< HEAD
                ->where('chapter','=',$chapter->id)->count();                
            }
            $course->courseChapter=$courseChapter;            
=======
                ->where('chapter','=',$chapter->id)->count();
            }
            $course->courseChapter=$courseChapter;
>>>>>>> 6e9f86a94b7e4768789f6b1f24bec6ee94a1906e
            return view('WebFrontend.courseDetails',compact('course'));
        }
        else
        {
            abort('404');
        }
<<<<<<< HEAD
        
=======

>>>>>>> 6e9f86a94b7e4768789f6b1f24bec6ee94a1906e
    }
}

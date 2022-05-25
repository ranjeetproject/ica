<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Chapter;
use App\ChapterDetail;
use App\StudentChapterRead;
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
            $courseChapter = Chapter::where('course_id','=',$course->id)->where('status', "1")->orderBy('chapter_order', 'ASC')->get();
            foreach($courseChapter as $chapter)
            {
                $chapter->topicsCount = ChapterDetail::where('course','=',$course->id)
                    ->where('chapter','=',$chapter->id)->count();

                $chapter_read_status_count =  StudentChapterRead::where('chapter', $chapter->id)
                                            ->where('student_id', Auth::user()->id)->where('read_status', 1)->count();

                $chapter->read_count_percentage = (($chapter_read_status_count/$chapter->topicsCount)*100);
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
<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Chapter;
use App\ChapterDetail;




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
        $topics = [];
        $courseDetails = Course::find($id);
        $data['courseChapter'] = Chapter::where('course_id','=',$courseDetails->id)->get();
        foreach($data['courseChapter'] as $chapter){
            $topics[] = ChapterDetail::where('course','=',$courseDetails->id)->where('chapter','=',$chapter->id)->count();
            
        }
        return view('WebFrontend.courseDetails',compact('courseDetails','topics'),$data);
    }
}
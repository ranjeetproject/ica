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
            $previousChapterCompletePercentage=100;
            foreach($courseChapter as $chapter)
            {
                $chapter->topicsCount = ChapterDetail::where('course','=',$course->id)
                    ->where('chapter','=',$chapter->id)->count();

                $chapter_read_status_count =  StudentChapterRead::where('chapter', $chapter->id)
                                            ->where('student_id', Auth::user()->id)->where('read_status', 1)->count();

                $chapter->read_count_percentage = (($chapter_read_status_count/$chapter->topicsCount)*100);
                if($previousChapterCompletePercentage==100){
                    $chapter->displayOrNot=1;
                }
                else{
                    $chapter->displayOrNot=0;
                }
                $previousChapterCompletePercentage=$chapter->read_count_percentage;
                
            }
            $course->courseChapter=$courseChapter;
            //return $course;
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

    public function chapterLessionDisplay(Request $request, $courseId, $chapterId)
    {
        $data = [];
        if ($request->has('type')) 
        {
            $chapterDetails= ChapterDetail::where('chapter',  $chapterId)->where('type',  $request->get('type'))
            ->orderBy('chapter_order','ASC')->get();
        } else {
            $chapterDetails= ChapterDetail::where('chapter',  $chapterId)->orderBy('chapter_order','ASC')->paginate(1);
        }
       // $data['chapter']=Chapter::find($chapterId);


        foreach($chapterDetails as $value)
        {
            if($value->details_img!=null)
            {
                $imageDataArray=explode('.',$value->details_img);
                $value->extention=$imageDataArray[2];
            } 

            if($value->details_video!='')
            {
                $imageDataArray=explode('.',$value->details_video);
                $value->extention=$imageDataArray[2];
            }

            $readcount = StudentChapterRead::where('chapter_details_id', $value->id)->where('student_id',Auth::user()->id)->get()->count();
            if($readcount==0){
                $studentChapterReadObj = new StudentChapterRead();
                $studentChapterReadObj->student_id = Auth::user()->id;
                $studentChapterReadObj->chapter_details_id = $value->id;
                $studentChapterReadObj->course = $courseId;
                $studentChapterReadObj->subject = $value->subject;
                $studentChapterReadObj->chapter = $chapterId;
                $studentChapterReadObj->read_status = 1;
                $studentChapterReadObj->save();
            }
        }
        $data['chapterDetails']=$chapterDetails;

        $path=action('WebFrontend\CourseController@courseDetail',[$courseId]);
        if($chapterDetails->previousPageUrl()==null){
            $data['previousPageUrl']=$path; 
        }
        else{
            $data['previousPageUrl']=$chapterDetails->previousPageUrl(); 
        }
        if($chapterDetails->nextPageUrl()==null)
        {
            $data['nextPageUrl']=$path; 
        }
        else{
            $data['nextPageUrl']=$chapterDetails->nextPageUrl(); 
        }
        


        
       
        $data['lastPage']=$chapterDetails->LastPage(); 
        $data['hasMorePages']=$chapterDetails->hasMorePages(); 
        $data['currentPage']=$chapterDetails->currentPage(); 
        $data['page']=$path;
        $data['courseId']=$courseId;
        $data['chapterId']=$chapterId;
       // return $data;
        return view('WebFrontend.chapterDetails.lesson',$data);
    }





}
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
        if($request->ajax()){
            $data = Course::join('std_courses','std_courses.course','=','courses.id')
            ->where('courses.entry_from','NEW')
            ->where('std_courses.student', Auth::user()->id)
            ->groupBy('courses.id')
            ->paginate(8);
            $view = view('WebFrontend.all-course',compact('data'))->render();
            return response()->json(['last_page'=>$data->lastPage(),'html' => $view]);
        }
        return view('WebFrontend.myCourse',$data);
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
        if(Auth::check())
        {
            $data = []; 
            $data = Course::with('user')->whereHas('user')->with('lessons')->where('entry_from', 'NEW')->orderBy('created_at', 'DESC')->paginate(8);
            if($request->ajax()){
                $view = view('WebFrontend.all_courses_pagination',compact('data'))->render();
                return response()->json(['html' => $view]);
            }
            return view('WebFrontend.all_courses',compact('data'));
        }else{
            return redirect()->action('WebFrontend\DashboardController@dashboardPageDisplay');
        }
        
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
                if(isset($imageDataArray[2]))
                {
                    $value->extention=$imageDataArray[2];
                }
                else{
                    $value->extention='mp4';
                }
               
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


    public function academicDetailsFetch()
    {
        $studentCode='"'.Auth::user()->code.'"';
        $postFields='{
            "StudentCode":'.$studentCode.'
        }';
        $data=[];
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://new.icaerp.com/api/Data/searchstudent',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$postFields,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $data['apiData']=json_decode($response,true);
        return view('WebFrontend.academicDetail.listing',$data);
    }


    public function particulerAcademicDetailFetch($id)
    {
        $data=[];

        $studentCode='"'.Auth::user()->code.'"';
        $courseId='"'.$id.'"';
        $postFields='{
            "StudentCode":'.$studentCode.',
            "CourseId" : '.$courseId.'
        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://new.icaerp.com/api/Data/subjectstatus',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$postFields,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));        
        $response = curl_exec($curl);        
        curl_close($curl);
        $data['moduleStatus']=json_decode($response,true);
        //return $data;


        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://new.icaerp.com/api/Data/subjectDetailStatus',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$postFields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $subjectDetailsResponse = curl_exec($curl);
        curl_close($curl);
        $data['subjectDetailsResponse']=json_decode($subjectDetailsResponse,true);

        return view('WebFrontend.academicDetail.detail',$data);
    }

    public function viewAllMyCourses()
    {
        $data = [];
        $data = Course::join('std_courses','std_courses.course','=','courses.id')
        ->where('courses.entry_from','NEW')
        ->where('std_courses.student', Auth::user()->id)
        ->groupBy('courses.id')
        ->get();
            
       
        return view('WebFrontend.view-all-courses',compact('data'));
    }





}
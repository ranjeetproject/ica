<?php

namespace App\Http\Controllers\WebFrontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\StudentExam;
use App\StdCourse;
use App\Subject;
use App\Chapter;
use App\Chapter_details;
use App\StudentChapterRead;
use App\Exam;


class ChartController extends Controller
{
    public function viewProgressChart()
    {
       // return $data=$this->progressChartData();
        $data=$this->progressChartData();
        return view('WebFrontend.chart.progressChart',$data);
    }

    public function progressChartData()
    {
        $result = [];
        $student_exam = StudentExam::where('student_id', Auth::user()->id)->where('exam_for', '1')
                        ->orderBy('id', 'DESC')->limit(10)->get();
        
        $examPercentage=[];
        foreach ($student_exam as $value) 
        {
            if ($value->full_marks != 0) 
            {
                $full_marks = $value->full_marks;
                $obtain_marks = $value->obtain_marks;
                $percent = ($obtain_marks * 100 / $full_marks);
                $examPercentage[]= $percent;   
            }
        }
        $result['examProgressPercentage']=implode(',',$examPercentage);
        
        
        $student_exam = StudentExam::where('student_id', Auth::user()->id)->where('exam_for', '2')
                         ->orderBy('id', 'DESC')->limit(10)->get();        
        $competitiveProgressPercentage = [];
        foreach ($student_exam as $value) 
        {
            if ($value->full_marks != 0) 
            {
                $full_marks = $value->full_marks;
                $obtain_marks = $value->obtain_marks;
                $percent = ($obtain_marks * 100 / $full_marks);
                $competitiveProgressPercentage[]= $percent;
            }
        }
        $result['competitiveProgressPercentage'] = implode(',',$competitiveProgressPercentage);
      
        
        $student_course = StdCourse::where('student', Auth::user()->id)->limit(5)->get();
        $result1 = [];
        $m = 0;

        $asseigmentProgressArray=[];
        $chapterArray=[];
        $percentgeReadArray=[];
        $percentgeAssessmentArray=[];
        $percentgeTotal=[];
        foreach ($student_course as $course) 
        {
            $subjects = Subject::where('course_id', $course->course)->get();
            foreach ($subjects as $subject)
            {
                $chapters = Chapter::where('subject_id', $subject->id)->where('status', "1")->get();
                foreach( $chapters as $chapter ) 
                {
                    $ans_data1 = [];
                    $chapters = Chapter::where('subject_id', $subject->id)->where('status', "1")->get();
                    $chapter_count =  Chapter_details::where('chapter', $chapter->id)->get()->count();
                    $chapter_read_status_count =  StudentChapterRead::where('chapter', $chapter->id)->where('student_id', Auth::user()->id)->where('read_status', 1)->get()->count();
                    if ($chapter_count != 0) 
                    {                        

                        
                        $percent = ($chapter_read_status_count * 100 / $chapter_count);                        
                        $total_percent = $percent;

                        
                        $exams = Exam::where('chapter', $chapter->id)->get();
                        $obtain_marks = 0;
                        $full_marks = 0;
                        foreach( $exams as $exam ) {
                            $student_exam = StudentExam::where('student_id', Auth::user()->id)->where('exam_id', $exam->id)->where('exam_for', '3')->get();
                            foreach ($student_exam as $value) {
                                $obtain_marks += $value->obtain_marks;
                                $full_marks += $value->full_marks;
                            }
                        }
                        
                        $assess_percent = 0;
                        if ($full_marks != 0) {
                            $assess_percent = ($obtain_marks * 100 / $full_marks);
                            $total_percent = ($percent + $assess_percent) / 2;
                        }
                        
                        


                        $chapterArray[]=$chapter->chapter_name;
                        $percentgeReadArray[]=$percent;
                        $percentgeAssessmentArray[]=$assess_percent;
                        $percentgeTotal[]=$total_percent;

                        $m++;
                        if ($m==10) 
                            break;
                    }
                }
            }
        }
        $asseigmentProgressArray['chapterArray']=implode(',',$chapterArray);
        //return $asseigmentProgressArray['chapterArray'];
        $asseigmentProgressArray['percentgeReadArray']=implode(',',$percentgeReadArray);
        $asseigmentProgressArray['percentgeAssessmentArray']=implode(',',$percentgeAssessmentArray);
        $asseigmentProgressArray['percentgeTotal']=implode(',',$percentgeTotal);
        $result['asseigmentProgress'] = $asseigmentProgressArray;
        
        return $result;
    }
}

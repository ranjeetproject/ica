<?php

namespace App\Http\Controllers\WebFrontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\StudentExam;
use App\StdCourse;
use App\Subject;
use App\Chapter;
use App\ChapterDetail;
use App\StudentChapterRead;
use App\Exam;
use App\Course;


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
                    $chapter_count =  ChapterDetail::where('chapter', $chapter->id)->get()->count();
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

    public function allCourseProgress($studentId)
    {
        $return=[];
        // return view('WebFrontend.chart.courseProgress',$return);
        $studentCourse = StdCourse::where('student', $studentId)->get();
       // return $studentCourse;
        $result1 = [];
        $result2 = [];
        $result3 = [];
        foreach ($studentCourse as $course) 
        {
            $n_count = 0;
            $val1 = 0;
            $val2 = 0;
            $val3 = 0;
            $result2_det = [];

            $coursedet = Course::where('id', $course->course)->first();
            $subjects = Subject::where('course_id', $course->course)->get();
            foreach ($subjects as $subject) 
            {
                $chapters = Chapter::where('subject_id', $subject->id)->where('status', "1")->get();
                foreach( $chapters as $chapter ) 
                {
                    $ans_data1 = [];
                    $chapters = Chapter::where('subject_id', $subject->id)->where('status', "1")->get();
                    $chapter_count =  ChapterDetail::where('chapter', $chapter->id)->get()->count();
                    if ($chapter_count != 0) 
                    {
                        $chapter_read_status_count = StudentChapterRead::where('chapter', $chapter->id)->where('student_id', $studentId)
                                                    ->where('read_status', 1)->count();
                        
                        $ans_data1['id'] = $chapter->id;
                        $ans_data1['course'] = $course->course;
                        $ans_data1['course_name'] = $coursedet->course_name;
                        $ans_data1['chapter_name'] = $chapter->chapter_name;
                        $ans_data1['count'] = $chapter_count;
                        $ans_data1['read_count'] = $chapter_read_status_count;
                        $percent = ($chapter_read_status_count * 100 / $chapter_count);
                        $ans_data1['percentge_read']= ceil($percent);
                        $total_percent = $percent;
                        
                        $exams = Exam::where('chapter', $chapter->id)->get();
                        $obtain_marks = 0;
                        $full_marks = 0;
                        $result3_det = [];
                        foreach( $exams as $exam ) 
                        {
                            $student_exam = StudentExam::where('student_id', $studentId)->where('exam_id', $exam->id)->where('exam_for', '3')->get();
                            foreach ($student_exam as $value) {
                                $obtain_marks += $value->obtain_marks;
                                $full_marks += $value->full_marks;
                            }
                            
                            $result3_det['id'] = $exam->id;
                            $result3_det['exam_name'] = $exam->exam_name;
                            $result3_det['course'] = $course->course;
                            $result3_det['course_name'] = $coursedet->course_name;
                            $result3_det['chapter'] = $chapter->id;
                            $result3_det['chapter_name'] = $chapter->chapter_name;
                            
                            $last_obmarks = 0;
                            $last_fmarks = 0;
                            $lstudent_exam = StudentExam::where('student_id', $studentId)->where('exam_id', $exam->id)->where('exam_for', '3')->orderBy('id', 'DESC')->first();
                            if ($lstudent_exam != '') 
                            {
                                $last_obmarks = $lstudent_exam->obtain_marks;
                                $last_fmarks = $lstudent_exam->full_marks;
                                $lassess_percent = 0;
                                if ($last_fmarks != 0) {
                                    $lassess_percent = ($last_obmarks * 100 / $last_fmarks);
                                }
                                $result3_det['obtain_marks'] = $last_obmarks;
                                $result3_det['full_marks'] = $last_fmarks;
                                $result3_det['mark_per'] = round($lassess_percent);
                                
                                array_push($result3, $result3_det);
                            }
                        }
                        
                        $assess_percent = 0;
                        if ($full_marks != 0) {
                            $assess_percent = ($obtain_marks * 100 / $full_marks);
                            $total_percent = ($percent + $assess_percent) / 2;
                        }
                        $ans_data1['percentge_assessment']= ceil($assess_percent);
                        $ans_data1['percentge_total']= ceil($total_percent);
                        
                        $n_count++;
                        $val1 += $percent;
                        $val2 += $assess_percent;
                        $val3 += $total_percent;
                        
                        array_push($result1, $ans_data1);
                    }
                }
            }
            
         
            
            $cper_read = 0;
            $cper_asses = 0;
            $cper_tot = 0;
            
            if ($n_count>0) {
            
                $cper_read = $val1 / $n_count;
                $cper_asses = $val2 / $n_count;
                $cper_tot = $val3 / $n_count;
            }
            
           
            
            $result2_det['course_id'] = $course->course;
            $result2_det['course_name'] = $coursedet->course_name;
            $result2_det['per_read'] = ceil($cper_read);
            $result2_det['per_assess'] = ceil($cper_asses);
            $result2_det['per_tot'] = ceil($cper_tot);            
            array_push($result2, $result2_det);
            
        }

       $courseName=[];
       $readPercentage=[];
       $assignmentPercentage=[];
       $courseBackgroundColor=[];
       $assignmentBackgroundColor=[];
       foreach($result2 as $courseData)
       {
            $courseName[]=$courseData['course_name'];
            $readPercentage[]=$courseData['per_read'];
            $assignmentPercentage[]=$courseData['per_assess'];
            if($courseData['per_read']<21)
            {
                $courseBackgroundColor[]='#fe0000';
            }
            elseif($courseData['per_read']>20 && $courseData['per_read']<41)
            {
                $courseBackgroundColor[]='#fda501';              
            }
            elseif($courseData['per_read']>40 && $courseData['per_read']<61)
            {
                $courseBackgroundColor[]='#fefd07';
            }
            elseif($courseData['per_read']>60 && $courseData['per_read']<81)
            {
                $courseBackgroundColor[]='#04fc03';
            }
            elseif($courseData['per_read']>80)
            {
                $courseBackgroundColor[]='#00584c';
            }



            if($courseData['per_assess']<21)
            {
                $assignmentBackgroundColor[]='#fe0000';
            }
            elseif($courseData['per_assess']>20 && $courseData['per_assess']<41)
            {
                $assignmentBackgroundColor[]='#fda501';
            }
            elseif($courseData['per_assess']>40 && $courseData['per_assess']<61)
            {
                $assignmentBackgroundColor[]='#fefd07';
            }
            elseif($courseData['per_assess']>60 && $courseData['per_assess']<81)
            {
                $assignmentBackgroundColor[]='#04fc03';
            }
            elseif($courseData['per_assess']>80)
            {
                $assignmentBackgroundColor[]='#00584c';
            }
        }
        $courseProgressArray['courseName']=implode(',',$courseName);
        $courseProgressArray['readPercentageArray']=implode(',',$readPercentage);
        $courseProgressArray['assessmentPercentgeArray']=implode(',',$assignmentPercentage);
        $courseProgressArray['courseBackgroundColor']=implode(',',$courseBackgroundColor);
        $courseProgressArray['assignmentBackgroundColor']=implode(',',$assignmentBackgroundColor);
        $return['coursesProgress'] = $courseProgressArray;        
        return view('WebFrontend.chart.courseProgress',$return);
    }
    public function chapterWiseProgressList()
    {
        $courses = Course::join('std_courses','std_courses.course','=','courses.id')
        ->where('courses.entry_from','NEW')
        ->where('std_courses.student', Auth::user()->id)
        ->get();

        return view('WebFrontend.chapterWiseProgressChart.courseWiseProgressList',compact('courses'));
    }
    public function chaptereWiseProgressChart($courseId)
    {
        $data=$this->chapterWiseProgress($courseId);
        //return $data;
        return view('WebFrontend.chapterWiseProgressChart.chapterWiseProgressChart',$data);
    }

    public function chapterWiseProgress($courseId)
    {
        $student_course = StdCourse::where('student', Auth::user()->id)
        ->where('course', $courseId)
        ->get();
        
        $result1 = [];
        $m = 0;
        foreach ($student_course as $course) {
            $subjects = Subject::where('course_id', $course->course)->get();
            foreach ($subjects as $subject) {
                $chapters = Chapter::where('subject_id', $subject->id)->where('status', "1")->get();
                foreach( $chapters as $chapter ) {
                    $ans_data1 = [];
                    $chapters = Chapter::where('subject_id', $subject->id)->where('status', "1")->get();
                    $chapter_count =  ChapterDetail::where('chapter', $chapter->id)->get()->count();
                    $chapter_read_status_count =  StudentChapterRead::where('chapter', $chapter->id)->where('student_id', Auth::user()->id)->where('read_status', 1)->count();
                    if ($chapter_count != 0) {
                        $ans_data1['id'] = $chapter->id;
                        $ans_data1['chapter_name'] = $chapter->chapter_name;
                        $ans_data1['count'] = $chapter_count;
                        $ans_data1['read_count'] = $chapter_read_status_count;
                        $percent = ($chapter_read_status_count * 100 / $chapter_count);
                        $ans_data1['percentge_read']= $percent;
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
                        $ans_data1['percentge_assessment']= $assess_percent;
                        $ans_data1['percentge_total']= $total_percent;
                        
                        array_push($result1, $ans_data1);
                        $m++;
                        if ($m==10) 
                            break;
                    }
                }
            }
        }
       // return $result1;
       $chapterName=[];
       $readPercentage=[];
       $assignmentPercentage=[];
       $chapterBackgroundColor=[];
       $assignmentBackgroundColor=[];
       foreach($result1 as $chapterData)
       {
            $chapterName[]=$chapterData['chapter_name'];
            $readPercentage[]=$chapterData['percentge_read'];
            $assignmentPercentage[]=$chapterData['percentge_assessment'];
            if($chapterData['percentge_read']<21)
            {
                $chapterBackgroundColor[]='#fe0000';
            }
            elseif($chapterData['percentge_read']>20 && $chapterData['percentge_read']<41)
            {
                $chapterBackgroundColor[]='#fda501';              
            }
            elseif($chapterData['percentge_read']>40 && $chapterData['percentge_read']<61)
            {
                $chapterBackgroundColor[]='#fefd07';
            }
            elseif($chapterData['percentge_read']>60 && $chapterData['percentge_read']<81)
            {
                $chapterBackgroundColor[]='#04fc03';
            }
            elseif($chapterData['percentge_read']>80)
            {
                $chapterBackgroundColor[]='#00584c';
            }



            if($chapterData['percentge_assessment']<21)
            {
                $assignmentBackgroundColor[]='#fe0000';
            }
            elseif($chapterData['percentge_assessment']>20 && $chapterData['percentge_assessment']<41)
            {
                $assignmentBackgroundColor[]='#fda501';
            }
            elseif($chapterData['percentge_assessment']>40 && $chapterData['percentge_assessment']<61)
            {
                $assignmentBackgroundColor[]='#fefd07';
            }
            elseif($chapterData['percentge_assessment']>60 && $chapterData['percentge_assessment']<81)
            {
                $assignmentBackgroundColor[]='#04fc03';
            }
            elseif($chapterData['percentge_assessment']>80)
            {
                $assignmentBackgroundColor[]='#00584c';
            }
        }
        $courseName = Course::find($courseId)->course_name;
        $chapterProgressArray['courseName']=$courseName;
        $chapterProgressArray['chapterName']=implode(',',$chapterName);
        $chapterProgressArray['readPercentageArray']=implode(',',$readPercentage);
        $chapterProgressArray['assessmentPercentageArray']=implode(',',$assignmentPercentage);
        $chapterProgressArray['chapterBackgroundColor']=implode(',',$chapterBackgroundColor);
        $chapterProgressArray['assignmentBackgroundColor']=implode(',',$assignmentBackgroundColor);
        $return['chapterProgress'] = $chapterProgressArray;     
        
        return $return;
    } 
}
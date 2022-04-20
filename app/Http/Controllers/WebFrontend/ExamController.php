<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exam;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\StdCourse;
use App\StudentExam;
use App\StdExam;


class ExamController extends Controller
{
    public function myExam()
    {
        $exams = Exam::select('exams.id as ex_id','std_exam.id as std_exam_id','exams.exam_code','exams.exam_name',
        'exams.exam_details','exams.course','exams.centre','exams.chapter','exams.subject','exams.type','exams.exam_zone','exams.exam_for','exams.duration')
        ->leftJoin('std_exam','std_exam.exam','=','exams.id')
        ->where('std_exam.student','=', Auth::user()->id)
        ->where('exams.exam_for','=',1)->where('exams.status','=',1)->paginate(8);
        foreach($exams as $exam){
            $question = Question::where('exam_id', $exam->ex_id)->where('state', '1')->count();
            if($question>0){
                return view('WebFrontend.exam-list',compact('exams'));
            }
        }
        
    }

    public function examInstruction($id)
    {
        return view('WebFrontend.exam-instruction',compact('id'));
    }

    public function examStart($id)
    {
        $student = Auth::user()->id;
        $stdcors = StdCourse::where('student', $student)->get();
        $stdcors = StdExam::where('student', $student)->get();
        $data = array();
        foreach ($stdcors as $value) {
            $exam_get =  Exam::where('id', $id)->where('exam_for', 1)->where('status', '1')->get();
            if (count($exam_get) > 0) {
                foreach ($exam_get as $value_ex) {
                    $datet = $value_ex->datet;
                    $datet_arr = explode("-",$datet);
                
                    $stime = $value_ex->start_time;
                    $stime_arr = explode(":",$stime);
                
                    $etime = $value_ex->end_time;
                    $etime_arr = explode(":",$etime);
                
                    $time = time() + 19800;
                    $st_time = mktime($stime_arr['0'],$stime_arr['1'],0,$datet_arr['1'],$datet_arr['2'],$datet_arr['0']);
                    $et_time = mktime($etime_arr['0'],$etime_arr['1'],0,$datet_arr['1'],$datet_arr['2'],$datet_arr['0']);
                
                    if ($value_ex->attempt_time!=0) {
                        $student_exam = StudentExam::where('student_id', $student)->where('exam_id', $id)->count();
                        //echo $student_exam;
                        if ($student_exam < $value_ex->attempt_time) {
                            if ($st_time < $time && $et_time > $time) {
                                $question = Question::where('exam_id', $id)->where('state', '1')->count();
                                if ($question > 0) {
                                    array_push($data,$value_ex);
                                }
                            }
                        }
                    } else {
                        $question = Question::where('exam_id', $id)->where('state', '1')->get()->count();
                        if ($question > 0) {
                            array_push($data,$value_ex);
                        }
                    }
                }
            }
        }
       // return $data;
        return view('WebFrontend.exam-start');
    }
    

    public function examSubmit()
    {
        return view('WebFrontend.exam-result');
    }
}
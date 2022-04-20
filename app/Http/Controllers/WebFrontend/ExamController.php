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
        ->join('std_exam','std_exam.exam','=','exams.id')
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
        $studentId = Auth::user()->id;
        //$stdcors = StdCourse::where('student', $request->student)->get();
        $value = StdExam::where('student', $studentId)->where('exam',$id)->first();
        $data = array();
        if($value) {
        $value_ex =  Exam::where('id', $value->exam)->where('exam_for', 1)
                        ->where('status', '1')->first();
            
                if ($value_ex) {
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
                        $student_exam = StudentExam::where('student_id', $studentId)->where('exam_id', $value_ex->id)->count();
                        //echo $student_exam;
                        if ($student_exam < $value_ex->attempt_time) {
                            if ($st_time < $time && $et_time > $time) {
                                $question = Question::where('exam_id', $value->exam)->where('state', '1')->count();
                                if ($question > 0) {
                                    $data = $value_ex;
                                }
                            }
                        }
                    } else {
                        $question = Question::where('exam_id', $value->exam)->where('state', '1')->count();
                        if ($question > 0) {
                            $data = $value_ex;
                        }
                    }
                }
            
    
        }
        //return $data;
        return view('WebFrontend.exam-instruction',compact('id','data'));
    }

    public function examStart($id)
    {
        $exams = Exam::where('id', $id)->first();
            if ($exams->question_limit > 0) {
                $data = Question::where('exam_id', $id)->where('state', 1)->paginate(1);
                //$data = Question::where('exam_id', $id)->where('state', 1)->inRandomOrder()->limit($exams->question_limit)->get();
            }else {
                $data = Question::where('exam_id', $id)->where('state', 1)->orderBy('id', 'ASC')->paginate(1);
            }
            foreach ($data as $value) {
                if ($value->type == "check" || $value->type == "radio" || $value->type == "accounting1" || $value->type == "accounting3" || $value->type == "accounting5") {
                    $value->qus_option = explode("=><",$value->qus_option);
                }
            }
        $data->exam_name = $exams->exam_name;
        //return $data;
        return view('WebFrontend.exam-start',compact('data','id'));
    }

    function fetch(Request $request)
    {   
       //dd($request->get('id'));
        if($request->ajax())
        {
            $exams = Exam::where('id', $request->get('id'))->first();
            if ($exams->question_limit > 0) {
                $data = Question::where('exam_id', $request->get('id'))->where('state', 1)->paginate(1);
                //$data = Question::where('exam_id', $id)->where('state', 1)->inRandomOrder()->limit($exams->question_limit)->get();
            }else {
                $data = Question::where('exam_id', $request->get('id'))->where('state', 1)->orderBy('id', 'ASC')->paginate(1);
            }
            foreach ($data as $value) {
                if ($value->type == "check" || $value->type == "radio" || $value->type == "accounting1" || $value->type == "accounting3" || $value->type == "accounting5") {
                    $value->qus_option = explode("=><",$value->qus_option);
                }
            }
            $data->exam_name = $exams->exam_name;
            return view('WebFrontend.custom-exam-start-pagination', compact('data'))->render();
        }
    }
    

    public function examSubmit()
    {
        return view('WebFrontend.exam-result');
    }
}
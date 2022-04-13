<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exam;
use Illuminate\Support\Facades\Auth;
use App\Question;


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
            $question = Question::where('exam_id', $exam->ex_id)->where('state', '1')->get()->count();
            if($question>0){
                return view('WebFrontend.exam-list',compact('exams'));
            }
        }
        // $exams = Exam::paginate(8);
        return view('WebFrontend.exam-list',compact('exams'));
        
    }

    public function examInstruction()
    {
        return view('WebFrontend.exam-instruction');
    }

    public function examStart()
    {
        return view('WebFrontend.exam-start');
    }
    

    public function examSubmit()
    {
        return view('WebFrontend.exam-result');
    }
}
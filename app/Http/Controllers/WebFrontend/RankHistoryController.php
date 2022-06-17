<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exam;
use App\StudentExam;
use Illuminate\Support\Facades\Auth;
use App\StudentAnswer;
use Illuminate\Support\Carbon;
use App\Question;
use App\StdCourse;
use App\StdExam;
use App\SecondaryAccount;
use App\PrimaryAccount;
use App\ReasonEquity;
use App\Account;

class RankHistoryController extends Controller
{
    public function rankHistoryList(Request $request){
        $array = [];
        $result = [];
        $studentExams = StudentExam::where('student_id', Auth::user()->id)->where('exam_for',2)
                        ->orderBy('created_at', 'DESC')->take(20)->get();
        
        foreach ($studentExams as $studentExam)
        {
            $exams = StudentExam::where('exam_id', $studentExam->exam_id)->orderBy('obtain_marks', 'DESC')
                    ->orderBy('total_duration', 'ASC')->get();
            $rank = 1;
            foreach ($exams as $exam) 
            {
                $ans_data = [];
                if ($exam->student_id == Auth::user()->id)
                {
                    $exam_name = Exam::where('id',$exam->exam_id)->first();
                    $net_marks = $exam['full_marks'];
                    $obtain_marks = $exam['obtain_marks'];
                    $marks_per = round(($obtain_marks * 100) / $net_marks);
                    $dt_arr = explode(" ", $exam['created_at']);
                    $date_arr = explode("-", $dt_arr[0]);
                  
                    $ans_data['id'] = $exam->id;
                    $ans_data['exam_name'] = $exam_name['exam_name'];
                    $ans_data['exam_for'] = $exam_name['exam_for'];
                    $ans_data['full_marks'] = $exam['full_marks'];
                    $ans_data['obtain_marks'] = $exam['obtain_marks'];
                    $ans_data['marks_percent'] = $marks_per;
                    $ans_data['rank'] = $rank;
                    $ans_data['time_taken'] = $exam['total_duration'];
                    $ans_data['date_time'] = $date_arr[2].'/'.$date_arr[1].'/'.$date_arr[0];
                    $ans_data['status'] = $exam->exam_status;
                    break; 
                }
                $rank++;
            }
            array_push($result, $ans_data);
        }
        
        $myArray = json_decode(json_encode($result), true);        
        $array = array_unique($myArray, SORT_REGULAR);

        $res_array = [];
        foreach ($array as $val)
        {
            if ($val['exam_name']!=null) 
            {
                $val_array = [];
                $val_array['id'] = $val['id'];
                $val_array['exam_name'] = $val['exam_name'];
                $val_array['exam_for'] = $val['exam_for'];
                $val_array['full_marks'] = $val['full_marks'];
                $val_array['obtain_marks'] = $val['obtain_marks'];
                $val_array['marks_percent'] = $val['marks_percent'];
                $val_array['rank'] = $val['rank'];
                $val_array['time_taken'] = $val['time_taken'];
                $val_array['date_time'] = $val['date_time'];
                $val_array['status'] = $val['status'];
                array_push($res_array, $val_array);
            }
        }
        return view('WebFrontend.rankHistory.rank-history-list',compact('res_array'));
    }

    public function examResult($studentExamId)
    {
        if($studentExamId>0)
        {
            $studentExam=StudentExam::find($studentExamId);
            if($studentExam)
            {
                $studentExam->markPercentage=round(($studentExam->obtain_marks/$studentExam->full_marks)*100);
                $studentExam->exam=Exam::find($studentExam->exam_id);
                if ($studentExam->exam->exam_for == 2) { //checking for competition/competitive 
                    if ($studentExam->exam->attempt_time!=0) {
                        $exam_end_date_time = new Carbon( $studentExam->exam->datet." ".$studentExam->exam->end_time);
                        $today = Carbon::now();
                        if($today > $exam_end_date_time) {
                            $studentExam->status = 'Completed';
                        } else {
                            $studentExam->status ="In progress";
                        }
        
                    } else {
                        $studentExam->status ="In progress";
                    }
                } else{
                    $studentExam->status ="In progress";
                }

                $competitive_exams = StudentExam::where('exam_id', 2)->where('exam_for',2)->orderBy('obtain_marks', 'DESC')->orderBy('total_duration', 'ASC')->get();
                $rank = 1;
                foreach ($competitive_exams as $value) {
                    if($value->student_id == Auth::user()->id) {
                        $studentExam->rank = $rank;
                    } else {
                        $rank++;
                    }
                }
                $studentExam->rank = $rank;

                $data['studentExam']=$studentExam;

                $studentAnswer=StudentAnswer::where('student_exam_id',$studentExam->id)->get();
                foreach($studentAnswer as $studentAnsValue)
                {
                    $question=Question::find($studentAnsValue->question_id);
                    if($question)
                    {                        
                        $studentAnsValue->qustionText = $question->qus;
                        $studentAnsValue->qustionOption = explode("=><",$question->qus_option);    
                        if($question->type=='check')
                        {
                            $studentAnsValue->questionOldAnswer=explode(",",$studentAnsValue->ques_old_answer);
                            $studentAnsValue->questionYourAnswer=explode(",",$studentAnsValue->ques_answer);
                        }    
                        if($question->type=='accounting1')
                        {
                            $studentAnsValue->questionOldAnswer=explode(",",$studentAnsValue->ques_old_answer);
                            $studentAnsValue->questionYourAnswer=explode(",",$studentAnsValue->ques_answer);
                        } 
                        if($question->type =="accounting2")
                        {
                            $studentOldAnsValueData=explode("},{",trim($studentAnsValue->ques_old_answer,'[{}]'));
                            $questionOldAnswer=[];
                            foreach($studentOldAnsValueData as $oldAnsvalue)
                            {
                                $questionOldAnswer[]=explode(',',$oldAnsvalue);
                            }
                            $studentAnsValue->questionOldAnswer=$questionOldAnswer;
                            $studentAnsValueData=explode("},{",trim($studentAnsValue->ques_answer,'[{}]'));
                            $questionYourAnswer=[];
                            foreach($studentAnsValueData as $YourAnsvalue)
                            {
                                $questionYourAnswer[]=explode(',',$YourAnsvalue);
                            }
                            $studentAnsValue->questionYourAnswer=$questionYourAnswer;

                            $studentAnsValue->primaryAccount=PrimaryAccount::get();
                            $studentAnsValue->secondaryAccount=SecondaryAccount::get();
                            $studentAnsValue->account=Account::where('question_id',$question->id)->get();

                           
                        } 
                        if($question->type == "accounting4")
                        {
                            $studentAnsValue->qustionOption=['Increase','Decrease','No-Impact'];
                            $studentAnsValue->qustionTextArray = explode("=><",$question->qus);
                            

                            $oldAnswer=[];
                            $oldAnswerArray=explode('{',trim($studentAnsValue->ques_old_answer,'[]'));                        
                            foreach($oldAnswerArray as $key=>$oldAnsValue)
                            {
                                if($key!=0)
                                {
                                    if($key==2 || $key==4 || $key==6)
                                    {
                                        $oldAnswer[]=explode(',',trim($oldAnsValue,':}},'));
                                    }
                                    else{
                                        $oldAnswer[]=trim($oldAnsValue,':}},');
                                    }
                                }                                    
                            } 
                            $studentAnsValue->questionOldAnswer=$oldAnswer;
                            
                            
                            $yourAnswer=[];
                            $yourAnswerArray=explode('{',trim($studentAnsValue->ques_answer,'[]'));                        
                            foreach($yourAnswerArray as $key=>$youeAnsValue)
                            {
                                if($key!=0)
                                {
                                    if($key==2 || $key==4 || $key==6)
                                    {
                                        $yourAnswer[]=explode(',',trim($youeAnsValue,':}},'));
                                    }
                                    else{
                                        $yourAnswer[]=trim($youeAnsValue,':}},');
                                    }
                                    
                                }                                    
                            }    
                            $studentAnsValue->questionYourAnswer=$yourAnswer;



                            $studentAnsValue->reasonEquity=ReasonEquity::get();
                            $studentAnsValue->secondaryAccount=SecondaryAccount::get();
                        }                   
                        if($question->type == "accounting5")
                        {
                            $studentAnsValue->qustionTextArray = explode("=><",$question->qus);
                            $studentAnsValue->questionOldAnswer=explode(",",$studentAnsValue->ques_old_answer);
                            $studentAnsValue->questionYourAnswer=explode(",",$studentAnsValue->ques_answer);
                        }
                        if($question->type=='accounting6')
                        {
                            $studentAnsValue->questionOldAnswer=explode(",",$studentAnsValue->ques_old_answer);
                            $studentAnsValue->questionYourAnswer=explode(",",$studentAnsValue->ques_answer);
                        }
                    }
                }
                $data['correctWrongAnswer']=$studentAnswer;
                if ($studentExam->exam['question_limit'] == 0) {
                    $questionLimit = Question::where('exam_id',  $studentExam->exam_id)->where('state', 1)->orderBy('id', 'ASC')->count();
                    $data['questionLimit'] = $questionLimit;
                }
                else{
                    $data['questionLimit'] = $studentExam->exam['question_limit'];
                } 

                return view('WebFrontend.rankHistory.rankDetails',$data);              
            }
            else{
                abort('404');
            }
        }
        else{
            abort('404');
        }
    }
}
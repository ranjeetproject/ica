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

    public function examResult($studentExamId,$studentExamName,$exam_for,$full_marks,$obtain_marks,$marks_percent,$rank,$time_taken,$status)
    {
        $studentExam = StudentExam::find($studentExamId);
        $examDetails = Exam::find($studentExam->exam_id);
        $data = [];
        if ($examDetails->question_limit == 0) {
            $questionLimit = Question::where('exam_id',  $examDetails->id)->where('state', 1)->orderBy('id', 'ASC')->count();
            $data['questionLimit'] = $questionLimit;
        }
        else{
            $data['questionLimit'] = $examDetails->question_limit;
        } 
        $data['exam_name'] = $studentExamName;
        $data['exam_for'] = $exam_for;
        $data['full_marks'] = $full_marks;
        $data['obtain_marks'] = $obtain_marks;
        $data['marks_percent'] = $marks_percent;
        $data['rank'] = $rank;
        $data['time_taken'] = $time_taken;
        $data['date_time'] = $examDetails->created_at;
        $data['status'] = $status;

        return view('WebFrontend.rankHistory.rankDetails',$data);              
            
    }
}
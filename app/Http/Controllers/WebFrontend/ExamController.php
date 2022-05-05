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
use App\SecondaryAccount;
use App\PrimaryAccount;
use App\Account;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class ExamController extends Controller
{
    public function myExam()
    {
        $exams = Exam::select('exams.id as ex_id','std_exam.id as std_exam_id','exams.exam_code','exams.exam_name',
        'exams.exam_details','exams.course','exams.centre','exams.chapter','exams.subject','exams.type','exams.exam_zone','exams.exam_for','exams.duration')
        ->join('std_exam','std_exam.exam','=','exams.id')
        ->where('std_exam.student','=', Auth::user()->id)
        ->where('exams.exam_for','=',1)->where('exams.status','=',1)->paginate(8);
        foreach($exams as $exam)
        {
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

    public function examStart(Request $request, $id)
    {
        $data=[];
        $exams = Exam::where('id', $id)->first();
        if($request->ajax())
        {
            if($request->has('page'))
            {
                if ($exams->question_limit > 0)
                {
                    $question = Question::where('exam_id', $id)->where('state', 1)->paginate(1);
                    foreach ($question as $value)
                    {
                        if ($value->type == "check" || $value->type == "radio" || $value->type == "accounting1" ||
                        $value->type == "accounting3" || $value->type == "accounting5")
                        {
                            $value->qus_option = explode("=><",$value->qus_option);
                        }
                    }
                }
                $html = view('WebFrontend.custom-exam-start-pagination', compact('question'))->render();
                return response()->json(['page'=>$question->currentPage()+1,'last_page'=>$question->lastPage(),'html'=>$html]);
            }
        }
        $data['examName'] = $exams->exam_name;
        $data['id'] = $id;
        $data['duration'] = $exams->duration;
        return view('WebFrontend.exam-start',$data);
    }

    public function examSubmit()
    {
        return view('WebFrontend.exam-result');
    }

    public function examQuestion(Request $request,$id)
    {
        $data=[];
        $exams = Exam::where('id', $id)->first();
        if($request->ajax())
        {            
            if ($exams->question_limit > 0) {
                //$data = Question::where('exam_id',  $id)->where('state', 1)->where('type','accounting5')->inRandomOrder()->limit($exams->question_limit)->get();
                $data = Question::where('exam_id',  $id)->where('state', 1)->inRandomOrder()->limit($exams->question_limit)->get();
            } else {

                $data = Question::where('exam_id',  $id)->where('state', 1)->orderBy('id', 'ASC')->get();
            }
            foreach ($data as $key=>$value)
            {
                $value->indexKey=  $key+1;
                if ($value->type == "check" || $value->type == "radio" || $value->type == "accounting1" || $value->type == "accounting3" || $value->type == "accounting5") {
                    $value->qus_option = explode("=><",$value->qus_option);
                    if($value->type == "accounting5")
                    {
                        $value->qus = explode("=><",$value->qus);
                    }
                }
                if($value->type == "accounting2")
                {
                    $value->primaryAccount=PrimaryAccount::get();
                    $value->secondaryAccount=SecondaryAccount::get();
                    $value->account=Account::get();
                }
            }
            $html = view('WebFrontend.exam.examInnerQuestion', compact('data'))->render();
            return response()->json(['html'=>$html]);
        }
        $data['examName'] = $exams->exam_name;
        $data['id'] = $id;
        $data['duration'] = $exams->duration;
        $data['questionLimit'] = $exams->question_limit;
        return view('WebFrontend.exam.exam-question',$data);
    }

    public function competitiveExam(Request $request)
    {
        $data = [];
        $compExam = Exam::select('exams.id as ex_id','std_exam.id as std_exam_id','exams.exam_code','exams.exam_name',
         'exams.exam_details','exams.course','exams.centre','exams.chapter','exams.subject','exams.type',
        'exams.exam_zone','exams.exam_for','exams.duration','exams.datet','exams.start_time','exams.end_time','exams.created_by','exams.tagging_for','exams.tagging_text','exams.quesstion_tag','exams.question_limit','exams.attempt_time')
        ->join('std_exam','std_exam.exam','=','exams.id')
        ->where('std_exam.student', Auth::user()->id)
        ->where('exams.exam_for', 2)
        ->where('exams.status', '1')
        ->get();
        if (count($compExam) > 0) {
            foreach ($compExam as $value_ex) {
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
                    $student_exam = StudentExam::where('student_id', Auth::user()->id)->where('exam_id', $value_ex->ex_id)->count();
                    if ($student_exam < $value_ex->attempt_time) {
                        if ($st_time < $time && $et_time > $time) {
                            $question = Question::where('exam_id', $value_ex->ex_id)->where('state', '1')->count();
                            if ($question > 0) {
                                $data[] = $value_ex;
                            }
                        }
                    }
                } else {
                    $question = Question::where('exam_id', $value_ex->ex_id)->where('state', '1')->count();
                    if ($question > 0) {
                        $data[] = $value_ex;
                    }
                }
            }
        }

         // Get current page form url e.x. &page=1
         $currentPage = LengthAwarePaginator::resolveCurrentPage();

         // Create a new Laravel collection from the array data
         $productCollection = collect($data);

         // Define how many products we want to be visible in each page
         $perPage = 10;

         // Slice the collection to get the products to display in current page
         $currentPageproducts = $productCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

         // Create our paginator and pass it to the view
         $comExam= new LengthAwarePaginator($currentPageproducts , count($productCollection), $perPage);

         // set url path for generted links
         $comExam->setPath($request->url());

         return view('WebFrontend.competitive-exam-list',compact('comExam'));

    }

    public function competitiveExamInstruction($id)
    {
        $studentId = Auth::user()->id;
        //$stdcors = StdCourse::where('student', $request->student)->get();
        $value = StdExam::where('student', $studentId)->where('exam',$id)->first();
        $data = array();
        if($value) {
        $value_ex =  Exam::where('id', $value->exam)->where('exam_for', 2)
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
        return view('WebFrontend.competitive-instruction',compact('id','data'));
    }

    public function competitiveExamStart(Request $request, $id)
    {
        $data=[];
        $exams = Exam::where('id', $id)->first();
        if($request->ajax())
        {            
            if ($exams->question_limit > 0) {
                $data = Question::where('exam_id',  $id)->where('state', 1)->where('type','accounting4')->inRandomOrder()->limit($exams->question_limit)->get();
                // $data = Question::where('exam_id',  $id)->where('state', 1)->inRandomOrder()->limit($exams->question_limit)->get();
            } else {

                $data = Question::where('exam_id',  $id)->where('state', 1)->orderBy('id', 'ASC')->get();
            }
            foreach ($data as $key=>$value)
            {
                $value->indexKey=  $key+1;
                if ($value->type == "check" || $value->type == "radio" || $value->type == "accounting1" || $value->type == "accounting3" || $value->type == "accounting5") {
                    $value->qus_option = explode("=><",$value->qus_option);
                    if($value->type == "accounting5")
                    {
                        $value->qus = explode("=><",$value->qus);
                    }
                }
                if($value->type == "accounting2")
                {
                    $value->primaryAccount=PrimaryAccount::get();
                    $value->secondaryAccount=SecondaryAccount::get();
                    $value->account=Account::get();
                }
            }
            $html = view('WebFrontend.exam.examInnerQuestion', compact('data'))->render();
            return response()->json(['html'=>$html]);
        }
        $data['examName'] = $exams->exam_name;
        $data['id'] = $id;
        $data['duration'] = $exams->duration;
        $data['questionLimit'] = $exams->question_limit;
        return view('WebFrontend.exam.competitive_question',$data);
    }


}

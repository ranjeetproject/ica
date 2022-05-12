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
use App\StudentAnswer;


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



    public function examQuestion(Request $request,$id)
    {
        $data=[];
        $exams = Exam::where('id', $id)->first();
        $fullMarks=0;
        if($request->ajax())
        {
            if ($exams->question_limit > 0) {
                //$data = Question::where('exam_id',  $id)->where('state', 1)->where('type','accounting2')->inRandomOrder()->limit($exams->question_limit)->get();
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
                $fullMarks=$fullMarks+$value->marks;
            }

            $html = view('WebFrontend.exam.examInnerQuestion', compact('data','fullMarks'))->render();
            return response()->json(['html'=>$html]);
        }
        $data['examName'] = $exams->exam_name;
        $data['id'] = $id;
        $data['duration'] = $exams->duration;
        $data['questionLimit'] = $exams->question_limit;
        //$data['questionLimit'] = 3;
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
        $fullMarks=0;
        $exams = Exam::where('id', $id)->first();
        if($request->ajax())
        {
            if ($exams->question_limit > 0) {
                //$data = Question::where('exam_id',  $id)->where('state', 1)->where('type','accounting4')->inRandomOrder()->limit($exams->question_limit)->get();
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
                $fullMarks=$fullMarks+$value->marks;
            }
            $html = view('WebFrontend.exam.examInnerQuestion', compact('data','fullMarks'))->render();
            return response()->json(['html'=>$html]);
        }
        $data['examName'] = $exams->exam_name;
        $data['id'] = $id;
        $data['duration'] = $exams->duration;
        $data['questionLimit'] = $exams->question_limit;
        return view('WebFrontend.exam.competitive_question',$data);
    }




    //////********* exam save starting  ***************/
    /**
     *  create result data array create by thete type
     */
    public function createResultSetData($inputData)
    {
        $input=$inputData;
        $radioAnswer=[];
        $checkboxAnswer=[];
        $accounting1Answer=[];
        $accounting2Answer=[];
        $accounting3Answer=[];
        $accounting4Answer=[];
        $accounting5Answer=[];
        $accounting6Answer=[];

        $data=[];
        $data['examId']=$input['examId'];
        foreach($input as $key=>$value)
        {
            if(strstr($key,"radioType"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)
                {
                    $questionId=$keyArray[1];
                    if (array_key_exists($questionId,$radioAnswer))
                    {
                        array_push($radioAnswer[$questionId],$value);
                    }
                    else
                    {
                        $radioAnswer[$questionId]=[];
                        array_push($radioAnswer[$questionId],$value);
                    }
                }
            }
            if(strstr($key,"checkboxType"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)
                {
                    $questionId=$keyArray[1];
                    if (array_key_exists($questionId,$checkboxAnswer))
                    {
                        $checkboxAnswer[$questionId]=$value;
                    }
                    else
                    {
                        $checkboxAnswer[$questionId]=[];
                        $checkboxAnswer[$questionId]=$value;
                    }
                }
            }
            if(strstr($key,"accounting1"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)
                {
                    $questionId=$keyArray[2];

                    if (array_key_exists($questionId,$accounting1Answer))
                    {
                        array_push($accounting1Answer[$questionId],$value);
                    }
                    else
                    {
                        $accounting1Answer[$questionId]=[];
                        array_push($accounting1Answer[$questionId],$value);
                    }
                }
            }
            if(strstr($key,"accounting2_"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)
                {
                    $questionId=$keyArray[2];
                    if (array_key_exists($questionId,$accounting2Answer))
                    {
                        $accounting2Answer[$questionId]=$value;
                    }
                    else
                    {
                        $accounting2Answer[$questionId]=[];
                        $accounting2Answer[$questionId]=$value;
                    }
                }
            }
            if(strstr($key,"accounting3"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)
                {
                    $questionId=$keyArray[2];
                    if (array_key_exists($questionId,$accounting3Answer))
                    {
                        $accounting3Answer[$questionId]=$value;
                    }
                    else
                    {
                        $accounting3Answer[$questionId]=[];
                        $accounting3Answer[$questionId]=$value;
                    }
                }
            }
            if(strstr($key,"accounting4"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)     {
                    $questionId=$keyArray[1];
                    $createKeyValueAssets= 'accounting4_'.$keyArray[1].'_Assets';
                    if($key==$createKeyValueAssets)
                    {
                        if($value==1)
                        {
                            $accounting4Answer[$questionId]['assets'][1][]=$input[$createKeyValueAssets.'_Increase_Option'];
                            $accounting4Answer[$questionId]['assets'][1][]=$input[$createKeyValueAssets.'_Increase_Text'];

                        }
                        elseif($value==2)
                        {
                            $accounting4Answer[$questionId]['assets'][2][]=$input[$createKeyValueAssets.'_Decrease_Option'];
                            $accounting4Answer[$questionId]['assets'][2][]=$input[$createKeyValueAssets.'_Decrease_Text'];
                        }
                        elseif($value==3)
                        {
                            $accounting4Answer[$questionId]['assets'][3]=true;
                        }
                    }
                    $createKeyValueLiabilities= 'accounting4_'.$keyArray[1].'_Liabilities';
                    if($key==$createKeyValueLiabilities)
                    {
                        if($value==1)
                        {
                            $accounting4Answer[$questionId]['liabilities'][1][]=$input[$createKeyValueLiabilities.'_Increase_Option1'];
                            $accounting4Answer[$questionId]['liabilities'][1][]=$input[$createKeyValueLiabilities.'_Increase_Option2'];
                            $accounting4Answer[$questionId]['liabilities'][1][]=$input[$createKeyValueLiabilities.'_Increase_Text'];

                        }
                        elseif($value==2)
                        {
                            $accounting4Answer[$questionId]['liabilities'][2][]=$input[$createKeyValueLiabilities.'_Decrease_Option1'];
                            $accounting4Answer[$questionId]['liabilities'][2][]=$input[$createKeyValueLiabilities.'_Decrease_Option2'];
                            $accounting4Answer[$questionId]['liabilities'][2][]=$input[$createKeyValueLiabilities.'_Decrease_Text'];
                        }
                        elseif($value==3)
                        {
                            $accounting4Answer[$questionId]['liabilities'][3]=true;
                        }
                    }
                    $createKeyValueEquity= 'accounting4_'.$keyArray[1].'_Equity';
                    if($key==$createKeyValueEquity)
                    {
                        if($value==1)
                        {
                            $accounting4Answer[$questionId]['equity'][1][]=$input[$createKeyValueEquity.'_Increase_Option1'];
                            $accounting4Answer[$questionId]['equity'][1][]=$input[$createKeyValueEquity.'_Increase_Option2'];
                            $accounting4Answer[$questionId]['equity'][1][]=$input[$createKeyValueEquity.'_Increase_Text'];

                        }
                        elseif($value==2)
                        {
                            $accounting4Answer[$questionId]['equity'][2][]=$input[$createKeyValueEquity.'_Decrease_Option1'];
                            $accounting4Answer[$questionId]['equity'][2][]=$input[$createKeyValueEquity.'_Decrease_Option2'];
                            $accounting4Answer[$questionId]['equity'][2][]=$input[$createKeyValueEquity.'_Decrease_Text'];
                        }
                        elseif($value==3)
                        {
                            $accounting4Answer[$questionId]['equity'][3]=true;
                        }
                    }

                }
            }
            if(strstr($key,"accounting5"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)
                {
                    $questionId=$keyArray[1];
                    if (array_key_exists($questionId,$accounting5Answer))
                    {
                        $accounting5Answer[$questionId]=$value;
                    }
                    else
                    {
                        $accounting5Answer[$questionId]=[];
                        $accounting5Answer[$questionId]=$value;
                    }
                }
            }
            if(strstr($key,"accounting6"))
            {
                $keyArray=explode("_",$key);
                if(count($keyArray)>0)
                {
                    $questionId=$keyArray[2];
                    if (array_key_exists($questionId,$accounting6Answer))
                    {
                        array_push($accounting6Answer[$questionId],$value);
                    }
                    else
                    {
                        $accounting6Answer[$questionId]=[];
                        array_push($accounting6Answer[$questionId],$value);
                    }
                }
            }
        }
        $data['radio']=$radioAnswer;
        $data['check']=$checkboxAnswer;
        $data['accounting1']=$accounting1Answer;
        $data['accounting2']=$accounting2Answer;
        $data['accounting3']=$accounting3Answer;
        $data['accounting4']=$accounting4Answer;
        $data['accounting5']=$accounting5Answer;
        $data['accounting6']=$accounting6Answer;
        return $data;
    }
    public function marksCalculet($resultSetData,$studentExamData)
    {
        $marks = [];
        $marks['full_marks'] = 0;
        $marks['obtain_marks'] = 0;
        foreach ($resultSetData as $key=>$value)
        {
            if($key=='radio')
            {
                foreach($value as $radioKey=>$radioValue)
                {
                   $radioBoxReturnData=$this->checkAnswerReturnMarks($radioKey, $radioValue[0]);
                   if(isset($radioBoxReturnData['marks']))
                   {
                        $this->saveStudentAnswer($studentExamData,$radioKey,$radioValue[0],$radioBoxReturnData['status'],$radioBoxReturnData['marks']);
                        $marks['full_marks'] += $radioBoxReturnData['marks'];
                        if ($radioBoxReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $radioBoxReturnData['marks'];
                        }
                   }
                }
            }
            if($key=='check')
            {
                foreach($value as $checkboxKey=>$checkboxValue)
                {
                   $checkboxStringValue=implode(',',$checkboxValue);
                   $checkBoxReturnData=$this->checkAnswerReturnMarks($checkboxKey, $checkboxStringValue);
                   if(isset($checkBoxReturnData['marks']))
                   {
                        $this->saveStudentAnswer($studentExamData,$checkboxKey,$checkboxStringValue,$checkBoxReturnData['status'],$checkBoxReturnData['marks']);
                        $marks['full_marks'] += $checkBoxReturnData['marks'];
                        if ($checkBoxReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $checkBoxReturnData['marks'];
                        }
                   }
                }
            }
            if($key=='accounting1')
            {
                foreach($value as $accounting1Key=>$accounting1Value)
                {
                   $accounting1StringValue=implode(',',$accounting1Value);
                   $accounting1ReturnData=$this->checkAnswerReturnMarks($accounting1Key, $accounting1StringValue);
                   if(isset($accounting1ReturnData['marks']))
                   {
                        $this->saveStudentAnswer($studentExamData,$accounting1Key,$accounting1StringValue,$accounting1ReturnData['status'],$accounting1ReturnData['marks']);
                        $marks['full_marks'] += $accounting1ReturnData['marks'];
                        if ($accounting1ReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $accounting1ReturnData['marks'];
                        }
                   }
                }
            }
            if($key=='accounting2')
            {
                foreach($value as $accounting2Key=>$accounting2Value)
                {
                    $accounting2StringValue='';
                    foreach($accounting2Value as $lineItemData)
                    {
                        if($accounting2StringValue=='')
                        {
                            $accounting2StringValue=$lineItemData;
                        }
                        else{
                            $accounting2StringValue=$accounting2StringValue.','.$lineItemData;
                        }
                    }
                    $accounting2StringValue='['.$accounting2StringValue.']';
                    $accounting2ReturnData=$this->checkAnswerReturnMarks($accounting2Key, $accounting2StringValue);
                    if(isset($accounting2ReturnData['marks']))
                    {
                        $this->saveStudentAnswer($studentExamData,$accounting2Key,$accounting2StringValue,$accounting2ReturnData['status'],$accounting2ReturnData['marks']);
                        $marks['full_marks'] += $accounting2ReturnData['marks'];
                        if ($accounting2ReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $accounting2ReturnData['marks'];
                        }
                    }
                }
            }
            if($key=='accounting3')
            {
                foreach($value as $accounting3Key=>$accounting3Value)
                {
                    $accounting3ReturnData=$this->checkAnswerReturnMarks($accounting3Key, $accounting3Value);
                    if(isset($accounting3ReturnData['marks']))
                    {
                        $this->saveStudentAnswer($studentExamData,$accounting3Key,$accounting3Value,$accounting3ReturnData['status'],$accounting3ReturnData['marks']);
                        $marks['full_marks'] += $accounting3ReturnData['marks'];
                        if ($accounting3ReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $accounting3ReturnData['marks'];
                        }
                    }
                }
            }
            if($key=='accounting4')
            {
                foreach($value as $accounting4Key=>$accounting4Value)
                {
                    $accounting4StringValue='';
                    $assetVal='';
                    $liabilitieVal='';
                    $equitytVal='';
                    foreach($accounting4Value as $innerKey=>$optionValuePair)
                    {
                        if($innerKey=='assets')
                        {
                            foreach($optionValuePair as $key=>$valueOptionData)
                            {
                                if($key==1)
                                {
                                    $assetVal='{'.$key.":{".implode(',',$valueOptionData)."}}";
                                }
                                if($key==2)
                                {
                                    $assetVal='{'.$key.":{".implode(',',$valueOptionData)."}}";
                                }
                                if($key==3)
                                {
                                    $assetVal='{'.$key.":{}}";
                                }

                            }
                        }
                        if($innerKey=='liabilities')
                        {
                            foreach($optionValuePair as $key=>$valueOptionData)
                            {
                                //$liabilitieVal='{'.$key.":{".implode(',',$valueOptionData)."}}";
                                if($key==1)
                                {
                                    $liabilitieVal='{'.$key.":{".implode(',',$valueOptionData)."}}";
                                }
                                if($key==2)
                                {
                                    $liabilitieVal='{'.$key.":{".implode(',',$valueOptionData)."}}";
                                }
                                if($key==3)
                                {
                                    $liabilitieVal='{'.$key.":{}}";
                                }
                            }
                        }
                        if($innerKey=='equity')
                        {
                            foreach($optionValuePair as $key=>$valueOptionData)
                            {
                                //$equitytVal='{'.$key.":{}}";
                                if($key==1)
                                {
                                    $equitytVal='{'.$key.":{".implode(',',$valueOptionData)."}}";
                                }
                                if($key==2)
                                {
                                    $equitytVal='{'.$key.":{".implode(',',$valueOptionData)."}}";
                                }
                                if($key==3)
                                {
                                    $equitytVal='{'.$key.":{}}";
                                }
                            }
                        }
                    }
                    $accounting4StringValue='['.$assetVal.','.$liabilitieVal.','.$equitytVal.']';
                    $accounting4ReturnData=$this->checkAnswerReturnMarks($accounting4Key, $accounting4StringValue);
                    if(isset($accounting4ReturnData['marks']))
                    {
                        $this->saveStudentAnswer($studentExamData,$accounting4Key,$accounting4StringValue,$accounting4ReturnData['status'],$accounting4ReturnData['marks']);
                        $marks['full_marks'] += $accounting4ReturnData['marks'];
                        if ($accounting4ReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $accounting4ReturnData['marks'];
                        }
                    }

                }
            }
            if($key=='accounting5')
            {
                foreach($value as $accounting5Key=>$accounting5Value)
                {
                   $accounting5StringValue=implode(',',$accounting5Value);
                   $accounting5ReturnData=$this->checkAnswerReturnMarks($accounting5Key, $accounting5StringValue);
                   if(isset($accounting5ReturnData['marks']))
                   {
                        $this->saveStudentAnswer($studentExamData,$accounting5Key,$accounting5StringValue,$accounting5ReturnData['status'],$accounting5ReturnData['marks']);
                        $marks['full_marks'] += $accounting5ReturnData['marks'];
                        if ($accounting5ReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $accounting5ReturnData['marks'];
                        }
                    }
                }
            }
            if($key=='accounting6')
            {
                foreach($value as $accounting6Key=>$accounting6Value)
                {
                   $accounting6StringValue=implode(',',$accounting6Value);
                   $accounting6ReturnData=$this->checkAnswerReturnMarks($accounting6Key, $accounting6StringValue);
                   if(isset($accounting6ReturnData['marks']))
                   {
                        $this->saveStudentAnswer($studentExamData,$accounting6Key,$accounting6StringValue,$accounting6ReturnData['status'],$accounting6ReturnData['marks']);
                        $marks['full_marks'] += $accounting6ReturnData['marks'];
                        if ($accounting6ReturnData['status']=='true')
                        {
                            $marks['obtain_marks'] += $accounting6ReturnData['marks'];
                        }
                   }
                }
            }
        }
        return $marks;
    }

    /**
     * this function are used for check particular answer is correct or not
     */

    public function checkAnswerReturnMarks($questionId, $answerSet,$type=null)
    {
        $data=[];
        if($type==5)
        {
            $answerIsCorrect = Question::where('id', $questionId)->where('ans', $answerSet)->first();
            $questionData =  Question::find($questionId);
            if ($answerIsCorrect)
            {
                $ansMarks =$questionData->marks;
                $ansString = $questionData->ans;
                $corAnswerArray = explode(",", $ansString);
                $givenAnswerArray = explode(",", $answerSet);
                $i = 0;
                $j = 0;
                foreach ($givenAnswerArray as $val)
                {
                    if ($val!=0)
                    {
                        if ($val == $corAnswerArray[$i]) $j++;
                    }
                    $i++;
                }
                $obtainMarks = $ansMarks * $j / $i;

                $data['status'] = 'true';
                $data['marks'] = $obtainMarks;
                $data['ans'] = $questionData->ans;
            } else {
                $data['status'] = 'false';
                $data['marks'] = $questionData->marks;
                $data['ans'] = $questionData->ans;
            }
        }
        else{
            $answerIsCorrect = Question::where('id', $questionId)->where('ans', $answerSet)->first();
            $questionData =  Question::find($questionId);
            if ($answerIsCorrect)
            {
                $data['status'] = 'true';
                $data['marks'] = $questionData->marks;
                $data['ans'] = $questionData->ans;
            } else {
                $data['status'] = 'false';
                $data['marks'] = $questionData->marks;
                $data['ans'] = $questionData->ans;
            }
        }

        return $data;
    }

    /**
     * student answer save student answer table
     */
    public function saveStudentAnswer($studentExamData,$questionId,$answerData,$answerStatus,$markObtain)
    {
        $db = new StudentAnswer();
        $db->student_exam_id = $studentExamData->id;
        $db->student_id = $studentExamData->student_id;
        $db->exam_id = $studentExamData->exam_id;
        $db->question_id = $questionId;
        $db->ques_text='';
        $db->qus_image = "";
        $question=Question::find($questionId);
        if ($question->qus_image!="")
        {
            $db->qus_image = $question->qus_image;
        }

        $db->ques_type = $question->type;
        $db->ques_old_answer = $question->ans;
        $db->ques_answer = $answerData;
        $db->ques_correct=0;
        $db->obtain_marks =0;
        if($answerStatus=='true')
        {
            $db->ques_correct = 1;
            $db->obtain_marks = $markObtain;
        }

        $db->ques_marks = $question->marks;
        $db->save();
        return true;
    }

    /**
     * main function for exam store
     */
    public function examSubmit(Request $request)
    {
        $input = $request->all();
        $resultSetData=$this->createResultSetData($input);
        //return $resultSetData;
        if(isset($resultSetData['examId']) && $resultSetData['examId']>0)
        {
            $exam = Exam::find($resultSetData['examId']);
            if($exam)
            {
                $examComplete = 0;
                if ($exam->exam_for == 2 && $exam->attempt_time!=0) {
                    $studentdExams = StudentExam::where('exam_id',$exam->id)->where('student_id',Auth::user()->id)
                                    ->orderBy('created_at', 'ASC')->get();
                    if (count($studentdExams) == $exam->attempt_time)
                    {
                        $examComplete = 1;
                    }
                }

                if ($examComplete == 1)
                {
                    $maxAttempt = 0;
                    foreach ($studentdExams as $studentdExam)
                    {
                        $maxAttempt++;
                        if ($maxAttempt == $exam->attempt_time)
                        {
                            $data['id'] = $studentdExam->id;
                            $data['status'] = true;
                            $data['mes']= 0;
                            return ('404');
                        }
                    }
                }
                else
                {
                    $studentExamData=[];
                    $studentExamData['exam_id']=$exam->id;
                    $studentExamData['student_id']=Auth::user()->id;
                    $studentExamData['total_duration']=10;
                    if ($exam->centre != '')
                    {
                        $studentExamData['centre_id']=$exam->centre;
                    }
                    else{
                        $studentExamData['centre_id']= 0;
                    }

                    $studentExamData['exam_for']=$exam->exam_for;
                    $studentExamData['exam_zone']=$exam->exam_zone;
                    $studentExamData['full_marks']=$input['total_marks'];
                    $studentExamData['obtain_marks']=0;
                    $studentExamData['exam_status']='Current';
                    $studentExam=StudentExam::create($studentExamData);
                    if($studentExam)
                    {
                        $marks = self::marksCalculet($resultSetData,$studentExam);
                        $studentExam->obtain_marks=$marks['obtain_marks'];
                        $studentExam->save();
                    }
                    $data['id'] = $studentExam->id;
                    $data['status'] = true;
                    $data['mes']= 0;
                }
                return redirect()->action('WebFrontend\ExamController@examResult',['id'=>$data['id']]);
            }
            else{
                return abort('404');
            }
        }
    }



    /**
     * this function are used for exam result
     */
    public function examResult($studentExamId)
    {
        if($studentExamId>0)
        {
            $studentExam=StudentExam::find($studentExamId);
            if($studentExam)
            {
                $studentExam->markPercentage=(($studentExam->obtain_marks/$studentExam->full_marks)*100);
                $studentExam->exam=Exam::find($studentExam->exam_id);
                $data['studentExam']=$studentExam;
                return view('WebFrontend.exam.exam-result',$data);
            }
            else{
                abort('404');
            }
        }
        else{
            abort('404');
        }
    }
    ///////////////////************* exam save end *****************//////////////////////////
}

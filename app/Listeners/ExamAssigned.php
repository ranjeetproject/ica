<?php

namespace App\Listeners;

use App\Events\ExamAssign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Exam;
use App\StdExam;

class ExamAssigned
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ExamAssign  $event
     * @return void
     */
    public function handle(ExamAssign $event)
    {
        //
        $student_id = Auth::user()->id;
        $allexams = Exam::where('tagging_for', ':All:')->get();
        foreach ($allexams as $allexam) {
            $stdexam1 = StdExam::where('student', $student_id)->where('exam', $allexam->id)->count();
            if ($stdexam1 == 0) {
                $db1 = new StdExam();
                $db1->student = $student_id;
                $db1->exam = $allexam->id;
                $db1->save();
            }else{
                return $stdexam1;
            }
        }
    }
}

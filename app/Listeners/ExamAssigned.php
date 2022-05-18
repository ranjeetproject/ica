<?php

namespace App\Listeners;

use App\Events\ExamAssign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Auth;
use App\Exam;
use App\StdExam;
use App\Http\Controllers\WebFrontend\UserController;

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
        $userControllerObj = new UserController();
        $userControllerObj->examTagging();
    }
}
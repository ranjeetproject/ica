<?php

namespace App\Listeners;

use App\Events\CourseAssign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Auth;
use App\Course;
use App\StdCourse;
use App\Http\Controllers\WebFrontend\UserController;
class CourseAssigned
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
     * @param  CourseAssign  $event
     * @return void
     */
    public function handle(CourseAssign $event)
    {
        $userControllerObj = new UserController();
        $userControllerObj->courseTagging();
        $userControllerObj->erpCourseTagging();
    }
}
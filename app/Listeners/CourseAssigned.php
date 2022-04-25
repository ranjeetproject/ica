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
        //
        //$studentCode= Auth::user()->code;
        // $allcourses = Course::where('tagging_for', ':All:')->get();
        // foreach ($allcourses as $allcourse) {
        //     $stdcourses1 = StdCourse::where('student', $student_id)->where('course', $allcourse->id)->count();
        //     if ($stdcourses1 == 0) {
        //         $db1 = new StdCourse();
        //         $db1->student = $student_id;
        //         $db1->course = $allcourse->id;
        //         $db1->save();
        //     }else{
        //         return $stdcourses1;
        //     }
        // }

        $userControllerObj = new UserController();
        $userControllerObj->courseTagging();
        $userControllerObj->erpCourseTagging();
    }
}
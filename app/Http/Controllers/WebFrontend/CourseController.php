<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function myCourses()
    {
        return view('WebFrontend.myCourse');
    }

    public function courseDetail($id)
    {
        return view('WebFrontend.courseDetails');
    }
}

<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exam;

class ExamController extends Controller
{
    public function myExam()
    {
        $exams = Exam::paginate(8);
        return view('WebFrontend.exam-list',compact('exams'));
    }
}
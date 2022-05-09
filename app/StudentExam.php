<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    // public static $table = "student_exam";
    protected $table ='student_exam';

    protected $fillable=['student_id','exam_id','centre_id','full_marks','obtain_marks','exam_for','total_duration','exam_status'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_code', 'exam_name', 'exam_details', 'course', 'centre', 'chapter', 'subject', 'status', 'type', 'exam_zone', 'exam_for', 'duration', 'datet' ,'start_time', 'end_time', 'created_by', 'tagging_for', 'tagging_text', 'quesstion_tag', 'question_limit', 'attempt_time'
    ];

    /**
     * The attributes that should be dates to native types.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function courseDetails()
    {
        return $this->belongsTo('App\Course', 'course', 'id');
    }
}
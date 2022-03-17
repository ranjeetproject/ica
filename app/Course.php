<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_code', 'course_name', 'entry_from', 'course_photo', 'created_by', 'course_type', 'courseduration', 'calias', 'coursegroupname', 'tagging_for', 'tagging_text','rating'
    ];

    /**
     * The attributes that should be dates to native types.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function lessons()
    {
        return $this->hasMany('App\Subject', 'course_id', 'id');
    }
}

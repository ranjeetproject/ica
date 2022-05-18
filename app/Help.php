<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
     protected $hidden = ['updated_at'];
     protected $dates = ['updated_at'];
     protected $fillable = ['student', 'subject', 'message'];
}
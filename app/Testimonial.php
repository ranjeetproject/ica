<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Testimonial extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['title', 'description', 'username', 'designation', 'user_image'];
}

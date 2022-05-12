<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HowItWork extends Model
{
    
    protected $table = 'how_it_works';
    protected $fillable = ['heading_title','title_one','title_two','title_three','title_four','image_one','image_two','image_three','image_four'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
}
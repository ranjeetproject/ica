<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function topics()
    {
        return $this->hasMany('App\ChapterDetail' ,'chapter');
    }
}
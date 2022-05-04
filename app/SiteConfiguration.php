<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteConfiguration extends Model
{
    
    protected $table = 'site_configurations';
    protected $fillable = ['footer_address','footer_email','footer_phone','footer_facebook','footer_twitter','footer_instagram','footer_pinterest','video_link','footer_text'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
}

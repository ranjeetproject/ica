<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    //
    protected $fillable = [
        'email','password','otp','mobile','state','city','centre','centre_code','pincode','address','status','profile_image','created_by','batch_id','device_id','device_token','last_active'
    ];

}
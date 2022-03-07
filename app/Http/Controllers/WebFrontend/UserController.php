<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;

class UserController extends Controller
{
    public function signUp()
    {
        return view('WebFrontend.registration');
    }

    public function loginForm()
    {
        return view('WebFrontend.login');
    }

    public function postLogin(Request $request)
    {
        $db = Student::where('code', $request->code)->get();
        
    }

    public function sendOTP(Request $request){
        dd($request->all());
      
    }
}
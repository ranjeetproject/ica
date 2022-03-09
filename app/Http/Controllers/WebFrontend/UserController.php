<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Student;
use App\User;


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
    public function registration(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'pincode' => 'integer',
            'mobile' => 'required'
        ], [
            'name.required' => 'Name is required',
            'address' => 'Address is required',
            'pincode.integer' => 'Pin Code should be a number',
            'mobile' => 'Mobile No is required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'mobile' => $request->mobile,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode
        ]);
    }
}

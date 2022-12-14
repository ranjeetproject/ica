<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Query;
use App\Cms;

class CmsController extends Controller
{
    //
    public function aboutUs(){
        $about = Cms::find(1);
        return view('WebFrontend.cms.about_us',$about);
    }
    public function termsAndCondition(){
        $termsAndCondition = Cms::find(2);
        return view('WebFrontend.cms.terms_and_condition',$termsAndCondition);
    }
    public function privacyPolicy(){
        $privacyPolicy = Cms::find(3);
        return view('WebFrontend.cms.privacy_policy',$privacyPolicy);
    }
    public function contactUs(){
	$contactUs= Cms::find(4);
        return view('WebFrontend.cms.contact_us',$contactUs);
    }
    
    public function submitQuery(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'mobile' => 'required|integer'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Not a valid Email Id',
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
            'mobile.required' => 'Mobile No is required'
        ]);

        $inputData = $request->only('name','email','mobile','subject','message');
        $queryInsert = Query::insert($inputData);

        Mail::send('WebFrontend.email.query_sent', ['subject' => $request->subject] , function ($m) use ($inputData) {
                $m->from('ica@gmail.com','ica');
                $m->to($inputData['email'],$inputData['name'])->subject('Query Registered Successfully');
        });

        if($queryInsert){
            \Session::flush();
            \Session::put('success','Query sent to our support team');
            return redirect()->route('contactUs');
        }else{
            \Session::flush();
            \Session::put('error','Failed! Something Wrong');
            return redirect()->route('contactUs');
        }
    }
}
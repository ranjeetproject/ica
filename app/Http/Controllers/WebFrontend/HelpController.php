<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class HelpController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $reply = Help::where('student', Auth::user()->id)->get();
            return view('WebFrontend.help.index',compact('reply'));
        }else{
            abort(404);
        }
    }

    public function store(Request $request)
    {   
        if(Auth::check()){
            $request->validate([
                'subject' => 'required',
                'message' => 'required',
            ]);
            $input = $request->all();
            $input['student'] = Auth::user()->id;
            $row = Help::create($input);
            if ($row && $row->id > 0) {
                return redirect()->action('WebFrontend\HelpController@index');
            } else {
                return redirect()->back();
            }
        }else{
            abort(404);
        }
    }


}
<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Session;
use GuzzleHttp\Client;

class TestimonialsController extends Controller
{
     
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	$testimonials = Testimonial::orderBy('id','DESC')->get();
	return view('admin.testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$input=$request->all();
	$request->validate([
            'title' => 'required|max:255',
            'description' =>'required',
	    'username' =>'required',
            'designation'=>'required'

            
        ]);

        if ($request->hasFile('user_image')){
            $rand_val           = date('YMDHIS') . rand(11111, 99999);
            $image_file_name    = md5($rand_val);
            $file               = $request->file('user_image');
            $fileName           = $image_file_name.'.'.$file->getClientOriginalExtension();
            $destinationPath    = public_path().'/testimonial_images';
            $file->move($destinationPath,$fileName);
            $input['user_image']    = $fileName ;
        }
	$row = Testimonial::create($input);
        
        if ($row && $row->id > 0) {
            return redirect()->action('Admin\TestimonialsController@index');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonials = Testimonial::find($id);
	return view('admin.testimonial.edit',compact('testimonials'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	$input=$request->all();
        $request->validate([
            'title' => 'required|max:255',
            'description' =>'required',
	    'username' =>'required',
            'designation'=>'required'

            
        ]);
	if ($request->hasFile('user_image')){
            $rand_val           = date('YMDHIS') . rand(11111, 99999);
            $image_file_name    = md5($rand_val);
            $file               = $request->file('user_image');
            $fileName           = $image_file_name.'.'.$file->getClientOriginalExtension();
            $destinationPath    = public_path().'/testimonial_images';
            $file->move($destinationPath,$fileName);
            $input['user_image']    = $fileName ;
        }
	$row = Testimonial::find($id);
	if ($row) {
            $row->update($input);
	    return redirect()->action('Admin\TestimonialsController@index');
	}else
	{
	   return redirect()->back();
	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

  }

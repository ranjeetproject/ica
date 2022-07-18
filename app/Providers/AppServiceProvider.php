<?php

namespace App\Providers;
use App\SiteConfiguration;
use App\Notification;
use Illuminate\Support\ServiceProvider;
use Auth;
use App\Student;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view)
        {
            $data=[];
            $data['setting_data']=SiteConfiguration::find(1);
            $data['notification_count'] = Notification::count();
            $data['notification_header_data'] = Notification::orderBy('id', 'desc')->take(3)->get();
            // if(Auth::check()){
            //     $current_date_time = date('Y-m-d h:i:s');
            //     $loginTime = Auth::user()->web_login_datetime;
            //     $interval = strtotime($current_date_time) - strtotime($loginTime);
            //     $min = abs($interval) / 60;
            //     if($min>=120){
            //         $student = Student::Where('id',Auth::user()->id)->update(['is_login_web' => 0,'web_login_ip_address'=>Null,'web_login_datetime'=>Null]);
            //         Auth::logout();
            //         return redirect()->action('WebFrontend\UserController@loginForm');
            //     }
            // }
            $view->with($data);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
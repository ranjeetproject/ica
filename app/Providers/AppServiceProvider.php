<?php

namespace App\Providers;
use App\SiteConfiguration;
use App\Notification;
use Illuminate\Support\ServiceProvider;
use Auth;

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

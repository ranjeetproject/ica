<?php

namespace App\Providers;
use App\SiteConfiguration;
use Illuminate\Support\ServiceProvider;

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

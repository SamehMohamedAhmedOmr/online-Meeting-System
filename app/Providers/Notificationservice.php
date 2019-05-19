<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Notification;
use Auth;
use View;
class Notificationservice extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer('*', function($view){
                $view->with('user', Auth::user());
                if(Auth::user()){
                    $data=Notification::where('user_id',Auth::user()->id)->orderby('id','desc')->offset(0)->limit(5)->get();
                }
                else{
                    $data = null;
                }
                View::share('data',$data);
            });

    }
}

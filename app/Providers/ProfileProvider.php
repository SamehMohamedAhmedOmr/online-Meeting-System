<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Auth;
use View;
class ProfileProvider extends ServiceProvider
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
                $profile=User::where('id',Auth::user()->id)->first();
            }
            else{
                $data = null;
            }
            View::share('profile',$profile);
        });
    }
}

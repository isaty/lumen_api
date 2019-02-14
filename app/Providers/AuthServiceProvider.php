<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            $api_token=$request->api_token;    
            if($api_token && $exist=User::where('api_token', '=', $api_token)->exists()) 
             {    
              return new User();
                }
                return null;
        });
        // $this->app['author']->viaRequest('api',function ($request){
        //     $api_token=$request->api_token;
        //     if($api_token && $exist=User::where('api_token', '=', $api_token)->where('type', '=', 'admin')->exists()) 
        //     {    
        //      return new User();
        //        }
        //        return null;
        // });
    }
}

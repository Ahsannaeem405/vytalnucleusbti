<?php

namespace App\Providers;

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
        //#

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $url=URL('/');
      
      //if($url == 'https://walrus-app-tcqpr.ondigitalocean.app/') {
       \Illuminate\Support\Facades\URL::forceScheme('https');
      
     // }
    }
}

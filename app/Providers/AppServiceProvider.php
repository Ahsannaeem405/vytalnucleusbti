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
        #
      if (env('DB_HOST') === '195.179.237.204') {
      \Illuminate\Support\Facades\URL::forceScheme('https');
        //dd(URL('/'));
      }
    }
}

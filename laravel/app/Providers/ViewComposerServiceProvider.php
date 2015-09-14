<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->composeMainLayout();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composeMainLayout(){

        view()->composer('layouts.main', function($view)
        {
            $user = Auth::User();
            $routename = Route::currentRouteName();


            $view->with('user', $user);
            $view->with('routename', $routename);

        });

    }
}

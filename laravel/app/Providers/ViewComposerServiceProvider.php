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
        $this->_composeMainLayout();

        $this->_composeManageTeamLayout();
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

    private function _composeMainLayout(){

        view()->composer('layouts.main', function($view)
        {
            $user = Auth::User();
            $routename = Route::currentRouteName();


            $view->with('user', $user);
            $view->with('routename', $routename);

        });

    }

    private function _composeManageTeamLayout(){

        view()->composer('layouts.manage_team', function($view)
        {
            $routename = Route::currentRouteName();
            $team_id = Route::input("team_id");

            $view->with('team_id', $team_id);
            $view->with('routename', $routename);
        });


    }

}

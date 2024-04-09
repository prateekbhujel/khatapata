<?php

namespace App\Providers;

use App\Models\Feature;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer(['*'], function ($view) {
            $url = url()->current();
            
            if ($url == url('/')) {
                $features = Feature::whereStatus('Active')->get();
                $view->with(compact('features'));
            }
        });
    }
}

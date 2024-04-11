<?php

namespace App\Providers;

use App\Models\Feature;
use App\Models\WebSetting;
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
            $url = url()->current() && url('/login');
            
            if ($url == url('/')) {
                $features = Feature::whereStatus('Active')->get();
                $settings = WebSetting::first();
                $view->with(compact('features', 'settings'));
            }
        });
    }
}

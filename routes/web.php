<?php

use Illuminate\Support\Facades\Route;

//Start of Front Routes.
Route::get('/', function () {
    return view('front.welcome');
});
//End of Forntend Route

//Admin or Backend Route 
Route::get('/admin', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard.index');
//End of Admin Route


// Auth::routes();

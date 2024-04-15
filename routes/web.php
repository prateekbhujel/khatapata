<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WebSettingsController;
use App\Http\Controllers\User\CategoriesController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UsersPasswordController;
use App\Http\Controllers\User\UsersProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/** 
 * Web routes for Admins. 
**/
Route::prefix('admin')->name('admin.')->group(function () {
    
    //Auth 'cms' middleware group start.
    Route::middleware('auth:cms')->group(function(){
        
        Route::middleware('active-only')->group(function(){
            
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

            Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
            
            Route::match(['put', 'patch'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');
            
            Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
            
            Route::match(['put', 'patch'], '/password/update', [PasswordController::class, 'update'])->name('password.update');
            
            Route::resource('staffs', StaffsController::class)->except(['show'])->middleware('admin-access');
            Route::resource('settings', WebSettingsController::class)->except(['show', 'edit', 'store', 'destroy'])->middleware('admin-access');
            
            Route::resources([
                'users'       => UsersController::class,
                'features'    => FeaturesController::class,
            ], 
            [
                'except'     => ['show']
            ]);

        });//End of active-only middleware
        Route::get('/inactive', function() {
            return view('admin.errors.inactive');
         })->name('errors.inactive');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
    });//End of 'cms' Middleware group.
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login.check');

});//End of Admin Route.


/** 
 * Web routes for User. 
**/
Route::prefix('user')->name('user.')->group(function () {
    
    //Auth 'auth' middleware group start.
    Route::middleware('auth')->group(function(){
        
        //active-only middleware
        Route::middleware('active-only')->group(function(){

            Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');

            Route::get('/profile/edit', [UsersProfileController::class, 'edit'])->name('profile.edit');
            
            Route::match(['put', 'patch'], '/profile/update', [UsersProfileController::class, 'update'])->name('profile.update');

            Route::get('/password/edit', [UsersPasswordController::class, 'edit'])->name('password.edit');
            
            Route::match(['put', 'patch'], '/password/update', [UsersPasswordController::class, 'update'])->name('password.update');

            Route::resources([
                'categories'  => CategoriesController::class,
            ], 
            [
                'except'     => ['show']
            ]);


        });//End of active-only middleware

        Route::get('/inactive', function() {
        return view('user.errors.inactive');
        })->name('errros.inactive');
        
    });//End Middleware group.

});//End of User Route.


//Start of Front Routes.
Route::get('/', function () {
    return view('welcome');
})->name('home');
//End of Forntend Route

Auth::routes();

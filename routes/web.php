<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffsController;
use App\Http\Controllers\Admin\UsersController;
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
            
            Route::resources([
                'users'      => UsersController::class,
                'features'   => FeaturesController::class,
            ], [
                'except'     => ['show']
            ]);

            Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
   
            Route::get('/inactive', function() {
               return view('admin.errors.inactive');
            })->name('errros.inactive');

        });//End of active-only middleware
        
    });//End Middleware group.
    
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
   
            Route::get('/inactive', function() {
               return view('user.errors.inactive');
            })->name('errros.inactive');

        });//End of active-only middleware
        
    });//End Middleware group.

});//End of User Route.


//Start of Front Routes.
Route::get('/', function () {
    return view('welcome');
})->name('home');
//End of Forntend Route

Auth::routes();

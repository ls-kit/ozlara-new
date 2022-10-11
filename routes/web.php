<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

// AUTH ROUTES
Route::post('register/submit', [UsersController::class, 'store'])->name('register.agent');
Route::post('/login', [UsersController::class, 'login'])->name('login.agent');

Route::group(['middleware' => ['verified', 'auth']],  function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // ADMIN ROUTES
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'],  function() {

        // ROLE MANAGEMETN ROUTES
        Route::resource('roles', RolesController::class, ['name' => 'roles']);
        Route::resource('users', UsersController::class, ['name' => 'users']);
    });
});

// SHOPIFY ROUTES
Route::get('/shopify-login',function(){
    return view('shopify.login');
})->name('shopify.login');

Route::group(['middleware' => ['verify.shopify']],  function() {
    Route::get('/', [WelcomeController::class, 'welcome'])->name('home');

    // THEME ROUTES
    Route::post('/theme/create', [SettingController::class, 'create']);
    Route::any('/theme/delete', [SettingController::class, 'destroy']);
});


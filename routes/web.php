<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

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


Route::get('/', function () {
    return view('welcome');
})->middleware(['verify.shopify'])->name('home');


Route::get('/products', function () {
    $products = Auth::user()->api()->rest('GET', '/admin/api/2022-10/products.json')['body'];
    return view('shopify.products', compact('products'));
})->middleware(['verify.shopify'])->name('products');


Route::get('/shopify-login',function(){
    return view('shopify.login');
})->name('shopify.login');

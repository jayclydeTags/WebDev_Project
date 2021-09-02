<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard');

Route::resource('products', ProductController::class);

Route::resource('file', FileController::class);

Route::get('/user/personal-information', function () {
    return view('custom.apps.profile.profile-1.personal-information');
});
Route::get('/user/overview', function () {
    return view('custom.apps.profile.profile-1.overview');
});

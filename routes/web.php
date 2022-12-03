<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleLoginTest;
use App\Http\Controllers\GithubLoginTest;
use App\Http\Controllers\SocialLogin;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('auth/google',[GoogleLoginTest::class,'google_login']);
Route::get('auth/google/callback',[GoogleLoginTest::class,'google_callback']);


Route::get('auth/github',[App\Http\Controllers\SocialLogin::class,'github_login']);
Route::get('auth/github/callback',[SocialLogin::class,'github_login_callback']);

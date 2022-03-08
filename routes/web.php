<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','WebFrontend\HomePageController@homePageDisplay');
Route::get('/signUp','WebFrontend\UserController@signUp');
Route::post('/registration','WebFrontend\UserController@registration')->name('registration');
Route::prefix('ica')->group(function ()
{
    Route::get('/login','WebFrontend\UserController@loginForm')->name('ica-login');
    Route::post('/post-login','WebFrontend\UserController@postLogin')->name('post-login');
    Route::post('/send-otp','WebFrontend\UserController@sendOTP')->name('send-otp');
    Route::post('/verify-otp','WebFrontend\UserController@verifyOTP')->name('verify-otp');

});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

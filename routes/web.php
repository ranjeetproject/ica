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
//Auth::routes();
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

Route::get('dashboard','WebFrontend\DashboardController@dashboardPageDisplay');
Route::get('my-courses','WebFrontend\CourseController@myCourses')->name('my-courses');
Route::get('course-details/{id}','WebFrontend\CourseController@courseDetail');
Route::get('my-exam','WebFrontend\ExamController@myExam')->name('my-exam');
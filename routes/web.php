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
Route::middleware(['withoutLogin'])->group(function ()//this middleware used for if login redirect to dashboard
{
    Route::get('/', 'WebFrontend\HomePageController@homePageDisplay');
    Route::get('/login', 'WebFrontend\UserController@loginForm')->name('login');
    Route::get('/sign-up', 'WebFrontend\UserController@signUp');
    Route::get('/check-otp', function(){
                $username = urlencode('icaedpho');
                $password = urlencode('icaedpho');
                $to = urlencode(8777435636);
                $from = urlencode('ICAEDU');


                // Prepare data for POST request
                $sms_data = 'username=' . $username . '&password=' . $password . '&to=' . $to . '&from=' . $from . '&dlr-mask=19&dlr-url=';
                // Send the GET request with cURL
                $ch = curl_init('https://103.229.250.200/smpp/sendsms?' . $sms_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                echo $response;
                curl_close($ch);
    });


    Route::post('/post-login', 'WebFrontend\UserController@postLogin')->name('post-login');
    Route::post('/registration', 'WebFrontend\UserController@registration')->name('registration');
    Route::get('/check-email', 'WebFrontend\UserController@checkEmailIsPresentOrNot')->name('checkEmailIsPresentOrNot');
    Route::get('/check-mobile-no', 'WebFrontend\UserController@checkMobileIsPresentOrNot')->name('checkMobileIsPresentOrNot');
    Route::post('/send-otp', 'WebFrontend\UserController@sendOTP')->name('send-otp');
    Route::post('/verify-otp', 'WebFrontend\UserController@verifyOTP')->name('verify-otp');
});

Route::get('/about-us','WebFrontend\CmsController@aboutUs')->name('aboutUs');
Route::get('/contact-us','WebFrontend\CmsController@contactUs')->name('contactUs');
Route::post('/submit-query','WebFrontend\CmsController@submitQuery')->name('submitQuery');
Route::get('/privacy-policy','WebFrontend\CmsController@privacyPolicy')->name('privacyPolicy');
Route::get('/terms-and-conditions','WebFrontend\CmsController@termsAndCondition')->name('termsAndCondition');
// Route::get('/home','WebFrontend\HomePageController@homePageDisplay')->name('home');

Route::middleware(['auth'])->group(function ()
{
    Route::get('dashboard', 'WebFrontend\DashboardController@dashboardPageDisplay')->name('dashboard');
    Route::get('my-courses', 'WebFrontend\CourseController@myCourses')->name('my-courses');
    Route::get('course-details/{id}', 'WebFrontend\CourseController@courseDetail');
    Route::get('my-exam','WebFrontend\ExamController@myExam')->name('my-exam');
    Route::get('exam-instruction','WebFrontend\ExamController@examInstruction')->name('exam-instruction');
    Route::get('exam-start','WebFrontend\ExamController@examStart')->name('exam-start');
    Route::get('exam-result','WebFrontend\ExamController@examSubmit')->name('exam-submit');





    Route::get('logout', 'WebFrontend\UserController@logout');
});
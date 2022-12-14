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
Route::get('/', 'WebFrontend\HomePageController@homePageDisplay');
Route::middleware(['withoutLogin'])->group(function ()//this middleware used for if login redirect to dashboard
{
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
Route::get('/all-courses','WebFrontend\CourseController@allCourses')->name('all-courses');
// Route::get('/home','WebFrontend\HomePageController@homePageDisplay')->name('home');
Route::get('/course-exam-event','WebFrontend\UserController@courseExamEvent')->name('course-exam-event');
Route::get('help','WebFrontend\HelpController@index')->name('help-form');
Route::post('help','WebFrontend\HelpController@store')->name('save-help');
Route::get('all-testimonial','WebFrontend\HomePageController@allTestimonials')->name('all-testimonial');


Route::middleware(['auth'])->group(function ()
{
   // Route::get('/', 'WebFrontend\DashboardController@dashboardPageDisplay')->name('dashboard');
    Route::get('dashboard', 'WebFrontend\DashboardController@dashboardPageDisplay')->name('dashboard');
    Route::get('dashboard-courses', 'WebFrontend\DashboardController@dashboardCourseDisplay');
    Route::get('dashboard-exams', 'WebFrontend\DashboardController@dashboardExamDisplay');

    

    Route::get('profile', 'WebFrontend\DashboardController@profilePage')->name('profile');
    Route::get('edit-profile/{id}', 'WebFrontend\DashboardController@editProfilePage');
    Route::post('update-profile/{id}', 'WebFrontend\DashboardController@updateProfilePage');
    Route::post('upload-profile-image', 'WebFrontend\DashboardController@profileImage');
    Route::get('my-courses', 'WebFrontend\CourseController@myCourses')->name('my-courses');
    Route::get('course-details/{id}', 'WebFrontend\CourseController@courseDetail');
    Route::get('my-exam','WebFrontend\ExamController@myExam')->name('my-exam');
    Route::get('exam-instruction/{id}','WebFrontend\ExamController@examInstruction')->name('exam-instruction');
    Route::get('exam-start/{id}','WebFrontend\ExamController@examStart')->name('exam-start');
    Route::get('pagination/fetch', 'WebFrontend\ExamController@fetch')->name('pagination-fetch');
    Route::get('exam-result/{id}/{examType?}','WebFrontend\ExamController@examResult')->name('exam-result');
    Route::get('exam-question/{id}','WebFrontend\ExamController@examQuestion')->name('exam-question');


    

    Route::get('chart','WebFrontend\ChartController@viewProgressChart');
    Route::get('all-course-progress/{studentId}','WebFrontend\ChartController@allCourseProgress');
   // Route::get('exam-question','WebFrontend\ExamController@examQuestion')->name('exam-question');
    Route::get('competitive-exam','WebFrontend\ExamController@competitiveExam')->name('competitive-exam');
    Route::get('competitive-exam-instruction/{id}','WebFrontend\ExamController@competitiveExamInstruction')->name('competitive-exam-instruction');
    Route::get('competitive-start-exam/{id}','WebFrontend\ExamController@competitiveExamStart')->name('competitive-start');


   
    

    Route::get('notification-list','WebFrontend\NotificationController@list')->name('notification-list');
    Route::get('chapter-details/{courseId}/{chapterId}','WebFrontend\CourseController@chapterLessionDisplay')->name('chapter-details');
    Route::get('assignment-exam/{courseId}/{chapterId}','WebFrontend\ExamController@assignmentExamQuestion')->name('assignment-exam');
    
    Route::get('rank-history','WebFrontend\RankHistoryController@rankHistoryList')->name('rank-history');
    Route::get('rank-history-details/{id}/{exam_name}/{exam_for}/{full_marks}/{obtain_marks}/{marks_percent}/{rank}/{time_taken}/{status}','WebFrontend\RankHistoryController@examResult');

    Route::get('academic-details','WebFrontend\CourseController@academicDetailsFetch');
    Route::get('academic-detail-fetch/{id}','WebFrontend\CourseController@particulerAcademicDetailFetch');

    Route::get('chapter-wise-progress','WebFrontend\ChartController@chapterWiseProgressList');
    Route::get('chapter-wise-progress-chart/{courseId}','WebFrontend\ChartController@chaptereWiseProgressChart');
    
    Route::get('view-all-my-courses', 'WebFrontend\CourseController@viewAllMyCourses')->name('view-all-my-courses');

    Route::get('logout', 'WebFrontend\UserController@logout');
    Route::post('exam-submit','WebFrontend\ExamController@examSubmit');
});

// Route::get('chapter-details/{chapterId}/{courseId}',function(){
//     dd('test');
// })->name('chapter-details');
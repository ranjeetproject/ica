<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function(){
    return "welcome";
   
});
Route::prefix('v2')->group(function(){
    Route::resource('student', 'Api\StudentController');
    
    Route::get('devicecorrection', 'Api\StudentController@devicecorrection'); //->middleware('auth:admin');
    // Route::get('lastactiveupdate', 'Api\StudentController@lastactiveUpdate');
    Route::get('accountupdate', 'Api\QuestionController@accountupdate');

    Route::post('login', 'Api\StudentController@login');
    Route::post('student-details', 'Api\StudentController@studentDetails');
    Route::post('admin-details', 'Api\StudentController@adminDetails');
    Route::post('razorpayorder', 'Api\StudentController@razorpayOrder');
    
    Route::post('update-token', 'Api\StudentController@updatetoken');
    
    Route::post('image-upload', 'Api\StudentController@imageUpload');
    Route::post('edit-profile', 'Api\StudentController@editProfile');
    
    Route::post('otp/verification', 'Api\StudentController@otpVerification');
    Route::post('courseverification', 'Api\StudentController@courseVerification');
    Route::resource('exam', 'Api\ExamController');
    // Route::post('exam', 'Api\ExamController@View');
    
    Route::resource('state', 'Api\StateController');
    Route::resource('city', 'Api\CityController');
    Route::resource('student-course', 'Api\StdCourseController');
    Route::resource('student/course', 'Api\StdCourseController');
    Route::resource('course', 'Api\CourseController');
    Route::resource('course/subject', 'Api\SubjectController');
    Route::resource('center', 'Api\CentreController');
    
    Route::post('allactivecourses', 'Api\CourseController@allactivecourses');

    Route::resource('subject/chapter', 'Api\ChapterController');
    
    Route::resource('question', 'Api\QuestionController');

    Route::resource('details', 'Api\ChapterDetailsController'); //->middleware('auth:admin');
    
    Route::resource('tagging', 'Api\TaggingController'); //->middleware('auth:admin');
    Route::post('tagging_course1', 'Api\TaggingController@taggingCourse'); //->middleware('auth:admin');
    
    Route::post('tutor/register', 'Api\TutorController@register'); //->middleware('auth:admin');
    
    Route::post('updatereadstatus', 'Api\ChapterDetailsController@updateReadStatus');
    
    Route::get('account', 'Api\QuestionController@account');
    Route::get('/account/{id}', 'Api\QuestionController@question_account');
    Route::get('primary_account', 'Api\QuestionController@primary_account');
    Route::get('secondary_account', 'Api\QuestionController@secondary_account');
    Route::get('reason_equity', 'Api\QuestionController@reason_equity');
    
    Route::post('exam-submit', 'Api\ResultController@examStor'); //->middleware('auth:admin');
    Route::post('exam-result', 'Api\ResultController@sendResult'); //->middleware('auth:admin');
    
    Route::post('progress', 'Api\ResultController@progress'); //->middleware('auth:admin');
    Route::post('rank-view', 'Api\ResultController@rank_view'); //->middleware('auth:admin');
    
    Route::post('allcourseprogress', 'Api\ResultController@allCourseProgress'); //->middleware('auth:admin');
    Route::post('course-progress', 'Api\ResultController@course_progress'); //->middleware('auth:admin');
    Route::post('chapter-progress', 'Api\ResultController@chapter_progress'); //->middleware('auth:admin');
    
    Route::post('slider', 'Api\SliderController@getall');
    
    Route::post('find-student', 'Api\StudentController@findstudent');
    
    Route::post('post-help', 'Api\StudentController@sendhelp');
    Route::post('get-help', 'Api\StudentController@gethelp');
    
    Route::post('login-device', 'Api\StudentController@login2');

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::middleware('auth:api')->get('/user/login', function (Request $request) {
    return $request->user();
});

/* user auth routes */
Route::post('/user', ['uses' => 'UserController@signup']);	// user signup
Route::post('/user/login', ['uses' => 'UserController@signin']);	// user login
Route::get('/user/list', ['uses' => 'UserController@index']);	// user login
Route::get('/user/info', ['uses' => 'UserController@userInfo']);	// get authenticated user info
Route::post('/user/logout', function() { return JWTAuth::parseToken()->invalidate(); });	// user logout

/* Students routes */
Route::get('students', ['uses' => 'StudentController@index', 'middleware' => 'auth.jwt']);	// get all the students
Route::get('student/{id}', ['uses' => 'StudentController@show', 'middleware' => 'auth.jwt']);	// get a single student
Route::post('student', ['uses' => 'StudentController@store', 'middleware' => 'auth.jwt']);	// add a single student
Route::put('student', ['uses' => 'StudentController@store', 'middleware' => 'auth.jwt']);	// update a single student
Route::delete('student/{id}', ['uses' => 'StudentController@destroy', 'middleware' => 'auth.jwt']);	// delete a single student

/* Teachers routes */
Route::get('teachers', ['uses' => 'TeacherController@index', 'middleware' => 'auth.jwt']); // get all teachers
Route::get('teacher/{id}', ['uses' => 'TeacherController@show', 'middleware' => 'auth.jwt']); // get a single teacher
Route::post('teacher', ['uses' => 'TeacherController@store', 'middleware' => 'auth.jwt']); // add a teacher
Route::put('teacher', ['uses' => 'TeacherController@store', 'middleware' => 'auth.jwt']); // update a teacher
Route::delete('teacher/{id}', ['uses' => 'TeacherController@destroy', 'middleware' => 'auth.jwt']); // delete a teacher

/* Parents routes */
Route::get('parents', ['uses' => 'ParentController@index', 'middleware' => 'auth.jwt']); // get all the parents
Route::get('parent/{id}', ['uses' => 'ParentController@show', 'middleware' => 'auth.jwt']);	// get a single parent
Route::post('parent', ['uses' => 'ParentController@store', 'middleware' => 'auth.jwt']);	// add a single parent
Route::put('parent', ['uses' => 'ParentController@store', 'middleware' => 'auth.jwt']);	// update a single parent
Route::delete('parent/{id}', ['uses' => 'ParentController@destroy', 'middleware' => 'auth.jwt']);	// delete a single parent

/* Result routes */
Route::get('results', ['uses' => 'ResultsController@index', 'middleware' => 'auth.jwt']);	// get all the results
Route::get('results/{id}', ['uses' => 'ResultsController@show', 'middleware' => 'auth.jwt']);	// get a single result
Route::post('results', ['uses' => 'ResultsController@store', 'middleware' => 'auth.jwt']);	// add a single result
Route::put('result', ['uses' => 'ResultsController@store', 'middleware' => 'auth.jwt']);	// update a single result
Route::delete('result/{id}', ['uses' => 'ResultsController@destroy', 'middleware' => 'auth.jwt']);	// delete result

/* School routes */
Route::get('schools', ['uses' => 'SchoolController@index', 'middleware' => 'auth.jwt']);	// get all the schools
Route::get('school/{id}', ['uses' => 'SchoolController@show', 'middleware' => 'auth.jwt']);	// get a single school
Route::post('school', ['uses' => 'SchoolController@store', 'middleware' => 'auth.jwt']);	// add a single school
Route::put('school', ['uses' => 'SchoolController@store', 'middleware' => 'auth.jwt']);	// update a single school
Route::delete('school/{id}', ['uses' => 'SchoolController@destroy', 'middleware' => 'auth.jwt']);	// delete school

/* Classes routes */
Route::get('classes', ['uses' => 'ClassController@index', 'middleware' => 'auth.jwt']);	// get all the schools
Route::get('class/{id}', ['uses' => 'ClassController@show', 'middleware' => 'auth.jwt']);	// get a single school
Route::post('class', ['uses' => 'ClassController@store', 'middleware' => 'auth.jwt']);	// add a single school
Route::put('class', ['uses' => 'ClassController@store', 'middleware' => 'auth.jwt']);	// update a single school
Route::delete('class/{id}', ['uses' => 'ClassController@destroy', 'middleware' => 'auth.jwt']);	// delete school

/** Send emails routes */
Route::post('resultsnotification', ['uses' => 'NotificationController@notifyByEmail', 'middleware' => 'auth.jwt']);
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

// Route::get('sparkpost','MailController@sendMail'); // send mail
//Email Qeue test route
Route::get('results', function(){
	$details['email'] = 'kamaunewton78@gmail.com';


	dispatch(new App\Jobs\SendResultsEmail($details));


	dd('Result');
});

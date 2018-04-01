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

Route::post('/user', ['uses' => 'UserController@signup']);
Route::post('/user/login', ['uses' => 'UserController@signin']);
Route::get('/user/info', function() {
   return JWTAuth::parseToken()->authenticate();
});
Route::post('/user/logout', function() {
   return JWTAuth::parseToken()->invalidate();
});

// list students
Route::get('students', ['uses' => 'StudentController@index', 'middleware' => 'auth.jwt']);

// show single student
Route::get('student/{id}', ['uses' => 'StudentController@show', 'middleware' => 'auth.jwt']);

// add a student
Route::post('student', ['uses' => 'StudentController@store', 'middleware' => 'auth.jwt']);

// update/edit a student
Route::put('student', ['uses' => 'StudentController@store', 'middleware' => 'auth.jwt']);

// delete student
Route::delete('student/{id}', ['uses' => 'StudentController@destroy', 'middleware' => 'auth.jwt']);

// list teachers
Route::get('teachers', 'TeacherController@index');

// show single teacher
Route::get('teacher/{id}', 'TeacherController@show');

// add a student
Route::post('teacher', 'TeacherController@store');

// update/edit a teacher
Route::put('teacher', 'TeacherController@store');

// delete teacher
Route::delete('teacher/{id}', 'TeacherController@destroy');

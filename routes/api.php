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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// list students
Route::get('students', 'StudentController@index');

// show single student
Route::get('student/{id}', 'StudentController@show');

// add a student
Route::post('student', 'StudentController@store');

// update/edit a student
Route::put('student', 'StudentController@store');

// delete student
Route::delete('student/{id}', 'StudentController@destroy');
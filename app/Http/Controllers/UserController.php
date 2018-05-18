<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use App\Models\School;
use App\Models\Teacher;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index() {
    // get logged in user school id
    $user_school = JWTAuth::parseToken()->toUser()->school;

    // get students of this school
    $users = User::where('school', $user_school)->get();

    // return a collection of users in a json format
    return response()->json([
      'success' => true,
      'users' => $users
    ], 200);
  }

  /*
    function to signup users to the app
  */
  public function signup(Request $request) {
    // validating the forms data
    $this->validate($request, [
        'firstname' => 'required',
        'lastname' => 'required',
        'phone' => 'required',
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'school' => 'required',
        'roles' => 'required',
        'level' => 'required',
        'hasTeacherObject' => 'required'
      ]);

    $user = new User([
      'user_firstname' => $request->input('firstname'),
      'user_lastname' => $request->input('lastname'),
      'user_phone' => $request->input('phone'),

      'username' => $request->input('username'),
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password')),

      'school' => $request->input('school'),
      'approved' => false,
      'roles' => $request->input('roles'),
      'level' => $request->input('level'),
      'avatar' => $request->input('avatar'),
      'hasTeacherObject' => $request->input('hasTeacherObject'),

      // TODO: add created by field
      'creatdBy' => JWTAuth::parseToken()->toUser()->username,
      'updatedBy' => JWTAuth::parseToken()->toUser()->username
    ]);
    
    // TODO: check if a user is a teacher | then add to teacher table
    // if ($request->input('hasTeacherObject')) {
    //   $teacher = new Teacher([
    //     // set the fields for teacher
    //   ]);
    // }

    if ($user->save()) {

      // call event to send activation
      // event(new UserRegistered($user));

      // return a json response
      return response()->json([
        'message' => 'Sussesfuly added User'
      ], 201);
    }
  }

  /*
    function to sigin users to the app
  */ 
  public function signin(Request $request) {
    // validating the forms data
    $this->validate($request, [
        'username' => 'required',
        'password' => 'required'
      ]);

    $credentials = $request->only('username', 'password');

    try {
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json([
          'error' => 'Invalid Credentials!'
          ], 401);
      }
    } catch (JWTException $e) {
      return response()->json([
        'error' => 'Could not create Token!'
        ], 500);
    }

    // succss creating token return the token
    return response()->json([
      'token' => $token
      ], 201); 
  }

  /*
    function to get a the loged in user info and the school data
  */
  public function userInfo() {
    // get the current user by passing the token
    $user = JWTAuth::parseToken()->authenticate();
    $schoolId = JWTAuth::parseToken()->toUser()->school;

    $schoolInfo = [];

    // get school info
    $schoolInfo['school'] = School::where('id', $schoolId)->get();

    // get teachers of school
    $schoolInfo['teachers'] = Teacher::where('teacher_school_id', $schoolId)->get();

    // get classes of school
    $schoolInfo['classes'] = ClassModel::where('school', $schoolId)->get();

    return response()->json([
      'user' => $user,
      'schInfo' => $schoolInfo
      ]);
  }
}

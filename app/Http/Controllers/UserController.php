<?php

namespace App\Http\Controllers;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /*
    function to signup users to the app
  */
  public function signup(Request $request) {
    // validating the forms data
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required'
      ]);

    $user = new User([
      'email' => $request->input('email'),
      'name' => $request->input('name'),
      'password' => bcrypt($request->input('password'))
    ]);

    $user->save();

    return response()->json([
      'message' => 'Sussesfuly added User'
    ], 201);
  }

  /*
    function to sigin users to the app
  */ 
    public function signin(Request $request) {
      // validating the forms data
      $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required'
        ]);

      $credentials = $request->only('email', 'password');

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
        ], 200); 
    }
}

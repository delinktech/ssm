<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function signup(Request $request) {
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
}
// App\Http\Controllers\Auth\UserController does not exist
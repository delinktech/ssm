<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use App\Models\ClassModel;

use App\Http\Resources\Classes as ClassResource;

class ClassController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // get logged in user school id
    $user_school = JWTAuth::parseToken()->toUser()->school;

    // get classes of this school
    $classes = ClassModel::where('school', $user_school)->get();

    // return a collection of classes in a json format
    return response()->json([
      'success' => true,
      'classes' => $classes
    ], 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $class = $request->isMethod('put') ? ClassModel::findOrFail($request->id) : new ClassModel;

    // validating the forms data
    $this->validate($request, [
      'code' => 'required|unique:classes',
      'name' => 'required',
      'school' => 'required',
      'classTeacher' => 'required'
    ]);

    $class->id = $request->input('id');

    $class->code = $request->input('code');
    $class->name = $request->input('name');
    $class->school = $request->input('school');
    $class->classteacher = $request->input('classTeacher');

    if ($class->save()) {
      // return a json
      return response()->json([
        'success' => true,
        'class' => $class
      ], 200);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // show a single class
    $student = ClassModel::findOrFail($id);

    return response()->json([
      'student' => $student
    ], 200);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // delete a class
    $student = ClassModel::findOrFail($id);

    if ($student->delete()) {
      // return a json
      return response()->json([
        'success' => true,
        'student' => $student
      ], 200);
    }
  }
}

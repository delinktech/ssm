<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
// use DB;

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
    // TODO: get only classes for school of the user
    // DB::select('SELECT * FROM classes WHERE school = user_school')

    $classes = ClassModel::Paginate(30);
    return ClassResource::collection($classes);
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

<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\School;
use App\Models\Teacher;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\School as SchoolResource;

class SchoolController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // get all the schools
    $schools = School::Paginate(30);
    return SchoolResource::collection($schools);
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
    // validate the school post data
    $this->validate($request, [
      'school_code' => 'required|unique:schools',
      'school_name' => 'required',
      'school_level' => 'required',
      'school_type' => 'required',
      'school_gender' => 'required',
      'school_county' => 'required',
      'school_sub_county' => 'required',
      'school_ward' => 'required',
      'school_phone' => 'required',
      'school_email' => 'required',
      'school_logo' => 'required'
      ]);

    // store school in the database
    $school = $request->isMethod('put') ? School::findOrFail($request->school_id) : new School;

    $school->id = $request->input('school_id');

    $school->school_code = $request->input('school_code');
    $school->school_name = $request->input('school_name');
    $school->school_level = $request->input('school_level');
    $school->school_type = $request->input('school_type');
    $school->school_gender = $request->input('school_gender');
    $school->school_county = $request->input('school_county');
    $school->school_sub_county = $request->input('school_sub_county');
    $school->school_ward = $request->input('school_ward');
    $school->school_phone = $request->input('school_phone');
    $school->school_email = $request->input('school_email');
    $school->school_logo = $request->input('school_logo');
    $school->createdBy = JWTAuth::parseToken()->toUser()->username;
    $school->updatedBy = JWTAuth::parseToken()->toUser()->username;

    if ($school->save()) {
      // return a json response
      return response()->json([
        'success' => true,
        'school' => $school
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
    $schoolinfo = [];
    // get school data
    $schoolinfo["school"] = School::find($id);

    // get teachers count
    $schoolinfo["teachers"] = Teacher::where('teacher_school_id', $schoolinfo['school']->id)->count();

    // get teachers count
    $schoolinfo["classes"] = ClassModel::where('school', $schoolinfo['school']->id)->count();

    // get students count
    $schoolinfo["students"] = Student::where('student_school', $schoolinfo['school']->id)->count();

    return response()->json([
      'school' => $schoolinfo
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
    // delete school
    $school = School::findOrFail($id);

    if ($school->delete()) {
      // return a json response
      return response()->json([
        'success' => true,
        'school' => $school
      ], 200);
    }
  }
}

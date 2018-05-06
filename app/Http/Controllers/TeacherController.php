<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\School;
use App\Models\Teacher;
use App\Http\Resources\Teacher as TeacherResource;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // TODO: get only teachers for a secific school
      // get all teachers
      $teachers = Teacher::orderBy('created_at', 'desc')->paginate(15);
 
      // return a collection of teachers
      return TeacherResource::collection($teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
       $teacher = Teacher::create([
            'first_name' => $request->first_name,
            'sur_name' => $request->sur_name,
            'id_number' => $request->id_number,
            'email' => $request->email,
            'username' => $request->username,
            'username' => $request->username,
            'teacher_dev_reg' => $request->teacher_dev_reg,
            'password' => $request->password,
            'status' => $request->status,
            'school_id' => $this->organisation_info->id,
            'subjects' => $request->subjects

        ]);
          return response()->json([
            'success' => true,
            'id' => $teacher->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate the teachers data
      $this->validate($request, [
        'teacher_code' => 'required|unique:teachers',
        'first_name' => 'required',
        'surname' => 'required',
        'id_number' => 'required',
        'email' => 'required',
        'status' => 'required',
        'school_id' => 'required',
        'subjects' => 'required' 
      ]);

      // store teacher in the databse check if put else is post
      $teacher = $request->isMethod('put') ? Teacher::findOrFail($request->teacher_id) : new Teacher;

      $teacher->id = $request->input('teacher_id');

      $teacher->teacher_code = $request->input('teacher_code');
      $teacher->teacher_school_id = $request->input('school_id');
      $teacher->first_name = $request->input('first_name');
      $teacher->teacher_surname = $request->input('surname');
      $teacher->teacher_id_number = $request->input('id_number');
      $teacher->subjects = $request->input('subjects');
      $teacher->teacher_email = $request->input('email');
      $teacher->teacher_dev_reg = $request->input('teacher_dev_reg');
      $teacher->teacher_api_session = $request->input('teacher_api_session');
      $teacher->teacher_status = $request->input('status');
      // remove
      $teacher->teacher_username = 'username';

      if ($teacher->save()) {
        return response()->json([
          'success' => true,
          'teacher' => $teacher
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
      $teacherinfo = [];
      // get single teacher details
      $teacherinfo['teacher'] = Teacher::findOrFail($id);

      // get school details
      $teacherinfo['school'] = School::findOrFail($teacherinfo['teacher']->teacher_school_id);

      // get class teacher

      // get teacher profile

      // return sngle teacher as a json
      return response()->json([
          'teacher' => $teacherinfo
          ]);
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
      // delete teacher
      $teacher = Teacher::findOrFail($id);

      if ($teacher->delete()) {
        // return sngle teacher as a resource
        return response()->json([
          'success' => true,
          'teacher' => $teacher
          ]);
      }
    }
}

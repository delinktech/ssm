<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Teacher;
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
       $this->validate($request, [
            'first_name' => 'required',
            'surname' => 'required',
            'id_number' => 'required',
            'email' => 'required',
            'username' => 'required',
            'teacher_dev_reg' => 'required',
            'password' => 'required',
            'status' => 'required',
            'school_id' => 'required',
            'class_id' => 'required',
            'subjects' => 'required'
            
        ]);
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
            'class_id' => $request->class_id,
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
      // store teacher in the databse
      $teacher = $request->isMethod('put') ? Teacher::findOrFail($request->teacher_id) : new Teacher;

      $teacher->id = $request->input('teacher_id');
      $teacher->teacher_code = $request->input('teacher_code');
      $teacher->class_id = $request->input('class_id');
      $teacher->teacher_school_id = $request->input('teacher_school_id');
      $teacher->teacher_id_number = $request->input('teacher_id_number');
      $teacher->teacher_surname = $request->input('teacher_surname');
      $teacher->teacher_email = $request->input('teacher_email');
      $teacher->teacher_dev_reg = $request->input('teacher_dev_reg');
      $teacher->teacher_api_session = $request->input('teacher_api_session');
      $teacher->teacher_status = $request->input('teacher_status');
      $teacher->teacher_user_id = $request->input('teacher_user_id');
      $teacher->teacher_password = $request->input('teacher_password');

      if ($teacher->save()) {
        return new TeacherResource($teacher);
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
      
      // get single teacher details
      $teacher = Teacher::findOrFail($id);

      // return sngle teacher as a resource
      return new TeacherResource($teacher);
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
      return new TeacherResource($teacher);
      }
    }
}

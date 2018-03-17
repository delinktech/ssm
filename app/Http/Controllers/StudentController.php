<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;
use App\Http\Resources\Student as StudentResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $students = Student::orderBy('created_at', 'desc')->paginate(10);
 
      // return a collection of students
      return StudentResource::collection($students);
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
      // store students in the databse
      $student = $request->isMethod('put') ? Student::findOrFail($request->student_id) : new Student;

      $student->id = $request->input('student_id');
      $student->student_reg = $request->input('student_reg');
      $student->class_id = $request->input('class_id');
      $student->student_first_name = $request->input('student_first_name');
      $student->student_second_name = $request->input('student_second_name');
      $student->student_last_surname = $request->input('student_last_surname');
      $student->student_dob = $request->input('student_dob');
      $student->student_gender = $request->input('student_gender');
      $student->student_parent = $request->input('student_parent');

      if ($student->save()) {
        return new StudentResource($student);
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
      // get single student details
      $student = Student::findOrFail($id);

      // return sngle student as a resource
      return new StudentResource($student);
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
      // delete student
      $student = Student::findOrFail($id);

      if ($student->delete()) {
        // return sngle student as a resource
        return new StudentResource($student);
      }
    }
}

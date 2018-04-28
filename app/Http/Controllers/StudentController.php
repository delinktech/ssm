<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\School;
use App\FileUpload;
use File;
use Storage;


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
      // TODO: only get students by school of logedin user
      $students = Student::Paginate(30);

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
      // validate the students form data
      $this->validate($request, [
        'regNum' => 'required|unique:students,',
        'firstName' => 'required',
        'secondName' => 'required',
        'lastName' => 'required',
        'gender' => 'required',
        'dob' => 'required',
        'school' => 'required',
        'class' => 'required',
        'parent' => 'required'
      ]);

      // store students in the databse
      $student = $request->isMethod('put') ? Student::findOrFail($request->student_id) : new Student;

      $student->id = $request->input('student_id');
      
      $student->student_reg = $request->input('regNum');
      $student->class_id = $request->input('class');
      $student->student_first_name = $request->input('firstName');
      $student->student_second_name = $request->input('secondName');
      $student->student_last_surname = $request->input('lastName');
      $student->student_dob = $request->input('dob');
      $student->student_gender = $request->input('gender');
      $student->student_school = $request->input('school');
      $student->student_parent = $request->input('parent');
      $student->passport_photo = $request->input('photo');

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
      $studentdetails = [];

      // get a single student
      $studentdetails['student'] = Student::findOrFail($id);

      // get student results

      // get student parent
      
      // return a json response
      return response()->json(['student' => $studentdetails], 200);
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

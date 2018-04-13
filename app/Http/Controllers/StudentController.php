<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;
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
      // $data["edit"] = $id;
      //   if (Auth::user()->teacher_username == 0) {
      //       $data['students'] = Student::where('school_id', $this->school_id->id)->orderBy('id', 'desc')->get();
      //   } else if (Auth::user()->user_id == 2) {
      //       $data['students'] = $this->getTeacherStudents();
      //   }
      $students = Student::Paginate(15);
      // return a collection of students
      // return view('students', 'StudentController@index');
      return StudentResource::collection($students);
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
            'reg_no' => 'required|unique:students,reg_no,NULL,id,organisation_info,' . $this->organisation_info->id,
            'surname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'reg_date' => 'required',
            'student_gender' => 'required',
            'passport_photo' => 'required',
            'student_school' => 'required'
        ]);
         $student = Student::create([
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'reg_no' => $request->reg_no,
            'adm_date' => new \DateTime($request->adm_date),
            'status' => Constants::ACTIVE_STUDENT,
            'parent_id' => 0,
            'passport_photo' => $request->passport_photo,
            'gender' => $request->gender,
            'school_id' => $this->organisation_info->id
        ]);
          return response()->json([
            'success' => true,
            'id' => $student->id
        ]);
    }
     public function multipleCreate(Request $request)
    {
        $template = "imports-" . date('YmdHiiss') . "." . $request->template->getClientOriginalExtension();
        $uploaded = $request->template->move(public_path('student-imports'), $template);
        //$tmp_name=UploadedFile::createFromBase($request->file('file'));

        // return $uploaded;

        $upload_file = asset($uploaded);

        // return $upload_file;

        $xlsx = new SimpleXLSX(file_get_contents($uploaded), true, true);


        list($num_cols, $num_rows) = $xlsx->dimension(1);
        $f = 0;
        $students_added = 0;
        $data = [];
        foreach ($xlsx->rows() as $r) {

            // Ignore the inital name row of excel file
            if ($f < 3) {
                $f++;
                continue;
            }

            $student = new Student();
            if ($r[1] == "" || $r[3] == "") {
                continue;
            }
            $student->surname = "" . $r[0];
            $student->first_name = "" . $r[1];
            $date_array = date_parse($r[2]);
            $date_string = date('Y-m-d H:i:s', mktime($date_array['hour'], $date_array['minute'], $date_array['second'], $date_array['month'], $date_array['day'], $date_array['year']));

            $student->adm_date = $date_string;
            $student->reg_no = $r[3];
            $student->gender = ($r[4] == "Male") ? "M" : ($r[4] == "M") ? "M" : "F";
            $student->status = 1;
            $student->school_id = $this->organisation_info->id;
            $student->others = "";
            $student->current_class_id = $request->class_id;
            $student->parent_id = 0;
            $student->passport_photo = "";


            
        }
        // return response()->json($data);
        return response()->json([
            'success' => true,
            'data' => $data,
            'records' => $students_added
        ]);
    }

    public function postStudentRegister(Request $request){
      $st = new Student;
      $st->first_name = $request->first_name;
      $st->second_name = $request->second_name;
      $st->last_name = $request->last_name;
      $st->dob = $request->dob;
      $st->reg_date = $request->reg_date;
      $st->student_gender = $request->student_gender;
      $st->passport_photo = FileUpload::photo($request,'photo');
      $st->student_school = $request->student_school;
      if($st->save())
      {
        $student_id = $st->student_id;
        Status::insert(['student_id'=>$student_id,'school_id'=>$request->school_id]);
        return back();
      }
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
      
      $student->student_first_name = $request->input('student_first_name');
      $student->student_second_name = $request->input('student_second_name');
      $student->student_last_surname = $request->input('student_last_surname');
      $student->student_dob = $request->input('student_dob');
      $student->student_gender = $request->input('student_gender');
      $student->reg_date = $request->input('reg_date');
      $student->student_gender = $request->input('student_gender');
      $student->passport_photo = $request->input('passport_photo');
      $student->student_school = $request->input('student_school');
     

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
      $data = [];
        $data["student"] = Student::find($id);
        $data["results"] = self::getStudentResults($id);
        $data["teacher"] = SchoolTeacher::where('student_id', $data["student"]->id)->get()->first();
        if ($id != -1) {

        }
        return view('../components/students-component/list/StudentsListComponent', $data);
    }

      public function getStudent($id)
    {
        $student = Student::find($id);
        $student->parent = SchoolParent::where('student_id', '=', $id)->get()->first();

        return response()->json($student);
    }

     private function getTeacherStudents()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->get()->first();

        $roles = [];
        $class_teacher = Stream::where('class_teacher', $teacher->id)->get(['id']);
        $subject_teacher = SubjectTeacher::where('teacher_id', $teacher->id)->get(['class_id']);

        foreach ($class_teacher as $item) {
            array_push($roles, $item);
        }
        foreach ($subject_teacher as $item) {
            //  array_push($roles,$item);
        }
        /*  array_push($roles,$class_teacher);
          array_push($roles,$subject_teacher);*/

        // return $roles;
       
        $students = Student::whereIn('teacher_class_id', $class_teacher)
            ->orWhereIn('teacher_class_id', $subject_teacher)
            ->orWhereIn('id', $members)
            ->get();

        return $students;
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
        
        $student = Student::find($id);
        if ($student == null) {
            return response("Could not update. No record found", 500);
        }
       q if ($student->reg_no == $request->reg_no) {
            $this->validate($request, [
            'first_name' => 'required',
            'reg_no' => 'required|unique:students,reg_no,NULL,id,organisation_info,' . $this->organisation_info->id,
            'surname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'reg_date' => 'required',
            'student_gender' => 'required',
            'passport_photo' => 'required',
            'student_school' => 'required'
            ]);
        } else {
            $this->validate($request, [
            'first_name' => 'required',
            'reg_no' => 'required|unique:students,reg_no,NULL,id,organisation_info,' . $this->organisation_info->id,
            'surname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'reg_date' => 'required',
            'student_gender' => 'required',
            'passport_photo' => 'required',
            'student_school' => 'required'
            ]);
        }

           $student->student_first_name = $request->input('student_first_name');
          $student->student_second_name = $request->input('student_second_name');
          $student->student_last_surname = $request->input('student_last_surname');
          $student->student_dob = $request->input('student_dob');
          $student->student_gender = $request->input('student_gender');
          $student->reg_date = $request->input('reg_date');
          $student->student_gender = $request->input('student_gender');
          $student->passport_photo = $request->input('passport_photo');
          $student->student_school = $request->input('student_school');
          $student->save();

        $parent = SchoolParent::where('student_id', '=', $student->id)->get()->first();
        if ($parent == null) {
            $parent = SchoolParent::create([
              'first_name' => $request->first_name,
              'second_name' => $request->second_name,
              'national_id' => $request->national_id,
              'phone_number' => $request->phone_number,
              'email' => $request->email,
              'county'=>request->county,
              'sub_county'=>request->sub_county,
              'ward'=>request->ward

            ]);
        } else {
            
              $parent->first_name = $request->input('first_name');
              $parent->second_name = $request->input('second_name');
              $parent->national_id = $request->input('national_id');
              $parent->phone_number = $request->input('phone_number');
              $parent->email = $request->input('email');
              $parent->parent_id = $request->input('parent_id');
              $parent->county = $request->input('county');
              $parent->sub_county = $request->input('sub_county');
              $parent->ward = $request->input('ward');
               $parent->save();
        }
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

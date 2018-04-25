<?php

namespace App\Http\Controllers;

use App\Models\School;
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
      $schools = School::Paginate(15);
      return SchoolResource::collection($schools);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->validate($request, [
            'school_code' => 'required',
            'school_name' => 'required',
            'school_reg_number' => 'required',
            'school_logo' => 'required',
            'school_level' => 'required',
            'school_type' => 'required',
            'school_gender' => 'required',
            'school_county' => 'required',
            'school_sub_county' => 'required',
            'school_ward' => 'required',
            'school_phone' => 'required',
            'school_email' => 'required'
            ]);
        $school = School::create([
            'school_code' => $request->school_code,
            'school_name' => $request->school_name,
            'school_reg_number' => $request->school_reg_number,
            'school_logo' => $request->school_logo,
            'school_level' => $request->school_level,
            'school_type' => $request->school_type,
            'school_gender' => $request->school_gender,
            'school_county' => $request->school_county,
            'school_sub_county' => $request->school_sub_county,
            'school_ward' => $request->school_ward,
            'school_phone' => $request->school_phone,
            'school_email' => $request->school_email
            
            ]);
        return response()->json([
            'success' => true,
            'id' => $school->id
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
        // store school in the database
       $school = $request->isMethod('put') ? School::findOrFail($request->school_id) : new School;
       $school->id = $request->input('school_id');

       $school->school_code = $request->input('school_code');
       $school->school_name = $request->input('school_name');
       $school->school_reg_number = $request->input('school_reg_number');
       $school->school_logo = $request->input('school_logo');
       $school->school_level = $request->input('school_level');
       $school->school_type = $request->input('school_type');
       $school->school_gender = $request->input('school_gender');
       $school->school_county = $request->input('school_county');
       $school->school_sub_county = $request->input('school_sub_county');
       $school->school_ward = $request->input('school_ward');
       $school->school_phone = $request->input('school_phone');
       $school->school_email = $request->input('school_email');

       if ($school->save()) {

        // return a json response
        return response()->json([
            'success' => true,
            'obj_saved' => $school
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
        $data = [];
        $data["school"] = Scchool::find($id);
        $data["teacher"] = SchoolTeacher::where('teacher_id', $data["teacher"]->id)->get()->first();
        if ($id != -1) {

        }
        return new SchoolResource($school);
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
          'obj_deleted' => $school
        ], 200);
      }
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ParentModel;

use App\Http\Resources\ParentRes as ParentResource;

class ParentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {   
    // get parents of a particuler school
    $parents = ParentModel::Paginate(30);
    return ParentResource::collection($parents);
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
    // validate inputs on server side
    $this->validate($request, [
      'firstname' => 'required',
      'secondname' => 'required',
      'nationalId' => 'required',
      'phone' => 'required',
      'county' => 'required',
      'sub_county' => 'required',
      'ward' => 'required'
    ]);

    // check if its put or post
    $parent = $request->isMethod('put') ? ParentModel::findOrFail($request->parent_id) : new ParentModel;

    $parent->id = $request->input('parent_id');

    // create the parent object
    $parent->parent_first_name = $request->input('firstname');
    $parent->parent_second_name = $request->input('secondname');
    $parent->parent_national_id = $request->input('nationalId');
    $parent->parent_Phone_number = $request->input('phone');
    $parent->parent_email = $request->input('email');
    $parent->parent_county = $request->input('county');
    $parent->parent_sub_county = $request->input('sub_county');
    $parent->parent_ward = $request->input('ward');

    // store parent in the databse
    if ($parent->save()) {
      return response()->json([
        'success' => true,
        'parent' => $parent,
        'message' => 'Parent Saved Successfuly'
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
    $studentdetails = [];

    // get single parent
    $studentdetails['parent'] = ParentModel::findOrFail($id);

    // get students
    $studentdetails['students'] = Student::where('student_parent', $studentdetails['parent']->id);
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
      //delete parent
      $parent = ParentModel::findOrFail($id);

      if ($parent->delete()) {
        return response()->json([
          'success' => true,
          'parent' => $parent
          ], 200);
      }
    }
}

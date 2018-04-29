<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Parent;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Parent::Paginate(15);
        return ParentResource::collection($parents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $id_no_exists=Parent::where('id_number','=',$request->id_number)->get()->first();

        if($id_no_exists!=null){
            return APIResponse::failResponse('The id number is already registered.');
        }

        $email_exists=Parent::where('email','=',$request->email)->get()->first();

        if($email_exists!=null){
            return APIResponse::failResponse('The email is already used.');
        }

        $this->validate($request, [
            'first_name' => 'required',
            'second_name' => 'required',
            'national_id' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'parent_id' => 'required',
            'county' => 'required',
            'county' => 'required',
            'sub_county' => 'required',
            'ward' => 'required'
        ]);


         $parent = Parent::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'national_id' => $request->national_id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'county'=>request->county,
            'sub_county'=>request->sub_county,
            'ward'=>request->ward

        ]);
          return response()->json([
            'success' => true,
            'id' => $parent->id
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

      // create the parent object
      $parent = new Parent([
        'parent_first_name' => $request->firstname,
        'parent_second_name' => $request->secondname,
        'parent_national_id' => $request->nationalId,
        'parent_Phone_number' => $request->phone,
        'parent_email' => $request->email,
        'parent_county'=>$request->county,
        'parent_sub_county'=>$request->sub_county,
        'parent_ward'=>$request->ward
      ]);

      // store parent in the databse
      if ($parent->save()) {
        return response()->json([
          'success' => true,
          'parentId' => $parent->id;
          'message' => 'Parent Saved Success'
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
        $data["parent"] = Parent::find($id);
        
        return view($parent);
    }

      public function getParent($id)
    {
        $parent = Parent::find($id);
        $student->parent = SchoolParent::where('student_id', '=', $id)->get()->first();

        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data = [];
        $data["parent"] = Parent::find($id);
        $data["student"] = self::getParentStudent($id);
        if ($id != -1) {

        }
        return view('../components/parent-component/list/ParentsListComponent', $data);
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
      $parent = Parent::findOrFail($id);

      if ($parent->delete()) {
        return response()->json([
          'success' => true,
          'parent' => $parent
          ], 200);
      }
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Parent;

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
            'parent_id' => 0,
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
         // store parent in the databse
      $parent = $request->isMethod('put') ? Parent::findOrFail($request->parent_id) : new Parent;

      $parent->id = $request->input('parent_id');
      
      $parent->first_name = $request->input('first_name');
      $parent->second_name = $request->input('second_name');
      $parent->national_id = $request->input('national_id');
      $parent->phone_number = $request->input('phone_number');
      $parent->email = $request->input('email');
      $parent->parent_id = $request->input('parent_id');
      $parent->county = $request->input('county');
      $parent->sub_county = $request->input('sub_county');
      $parent->ward = $request->input('ward');
        
        if ($parent->save()) {
        return new ParentResource($parent);
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
        //
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
        //
    }
}

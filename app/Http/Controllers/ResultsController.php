<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $results = Result::Paginate(15);
        return ResultResource::collection($results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->validate($request, [
            'student_id' => 'required',
            'grade' => 'required',
            'marks' => 'required'
            ]);

         $school = School::create([
            'student_id' => $request->student_id,
            'grade' => $request->grade,
            'marks' => $request->marks

            ]);


            return response()->json([
            'success' => true,
            'id' => $results->id
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
         // store result in the database
       $result = $request->isMethod('put') ? Result::findOrFail($request->result_id) : new Result;
       $result->id = $request->input('result_id');

       $result->student_id = $request->input('student_id');
       $result->grade = $request->input('grade');
       $result->marks = $request->input('marks');

       if ($result->save()) {
        return new ResultResource($result);
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
        $data["result"] = Scchool::find($id);
          if ($id != -1) {

        }
        return new ResultResource($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

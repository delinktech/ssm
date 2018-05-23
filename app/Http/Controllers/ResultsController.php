<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Resources\Result as ResultResource;

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

  public function retrieveResultsByTerm()
  {
    $result = DB::table('results')->get();
    foreach ($results as $result) {
    echo $result->term;
}

   
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
  */
  public function create()
  {
    // code
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

       $result->reg = $request->input('regnumber');
       $result->term = $request->input('term');
       $result->student = 1;
       $result->class = $request->input('class');
       $result->teacher = $request->input('teacher');
       $result->subject = $request->input('subjects');
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
    // delete single result
      $result = Result::findOrFail($id);

      if ($result->delete()) {
        // return sngle result as a resource
        return new ResultResource($result);
      }
    }

}

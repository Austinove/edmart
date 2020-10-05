<?php
namespace App\Http\Controllers;

use App\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("tasks.projects");
    }

    /**
     * Create new project
     */
    public function create(Request $request)
    {
        $inputs = $request->all();
        // return $request;
        $this->validate($request, [
            "desc" => "required",
            "fee" => "required|numeric",
            "Assmanager" => "required",
            "commencement" => "required",
            "completion" => "required"
        ]);
        try {
            $project = new Project();
            $project->save([
                "desc" => $inputs["desc"],
                "fee" => $inputs["fee"],
                "Assmanager" => $inputs["Assmanager"],
                "commencement" => $inputs["commencement"],
                "completion" => $inputs["completion"],
                "status" => "open",
            ]);
            return response()->json(Project::all());
        } catch (QueryException $th) {
            throw $th;
        }
        
    }
    
    /*
        fetch projects
    */
    public function fetProjetcs(Request $request)
    {
        Project::all();
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

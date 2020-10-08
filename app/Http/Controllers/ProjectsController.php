<?php
namespace App\Http\Controllers;

use App\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->validate($request, [
            "desc" => "required",
            "fee" => "required|numeric",
            "Assmanager" => "required",
            "commencement" => "required",
            "completion" => "required",
            "client" => "required",
            "title" => "required"
        ]);
        try {
            // $project = new Project([
            //     "client" => $inputs["client"],
            //     "desc" => $inputs["desc"],
            //     "fee" => $inputs["fee"],
            //     "Assmanager" => $inputs["Assmanager"],
            //     "commencement" => $inputs["commencement"],
            //     "completion" => $inputs["completion"],
            //     "title" => $inputs["title"],
            //     "status" => "open",
            // ]);
            // $project->save();
            return response()->json(Project::all());
        } catch (QueryException $th) {
            throw $th;
        }
        
    }
    
    /*
        fetch projects
    */
    public function fetchProjetcs(Request $request)
    {
        if(Auth::user()->userType === "admin"){
            return response()->json(Project::all());
        }else{
            return response()->json(
                Project::all(
                    "id", 
                    "title",
                    "client", 
                    "desc", 
                    "status", 
                    "Assmanager", 
                    "commencement", 
                    "completion"
                )
            );
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

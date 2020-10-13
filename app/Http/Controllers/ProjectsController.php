<?php
namespace App\Http\Controllers;

use App\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $project = new Project([
                "client" => $inputs["client"],
                "desc" => $inputs["desc"],
                "fee" => $inputs["fee"],
                "Assmanager" => $inputs["Assmanager"],
                "commencement" => $inputs["commencement"],
                "completion" => $inputs["completion"],
                "title" => $inputs["title"],
                "status" => "open",
            ]);
            $project->save();
            return $this->fetchProjetcs();
        } catch (QueryException $th) {
            throw $th;
        }
        
    }
    
    /*
        fetch projects
    */
    public function fetchProjetcs()
    {
        $pending =
            DB::table('expences')
            ->join("users", "expences.user_id", "=", "users.id")
            ->select(
                "expences.id",
                "expences.desc",
                "expences.created_at",
                "expences.user_id",
                "expences.amount",
                "users.name",
                "expences.status",
                "expences.reason"
            )
            ->where("expences.status", "=", "Not Viewed")
            ->orwhere("expences.status", "=", "Viewed")
            ->orderBy("created_at", "desc")->get();

        if(Auth::user()->userType === "admin"){
            $projects = DB::table("projects")
            ->join("users", "projects.Assmanager", "=", "users.id")
            ->select(
                "projects.id",
                "projects.title",
                "projects.client",
                "projects.desc",
                "projects.status",
                "users.name",
                "projects.Assmanager",
                "projects.commencement",
                "projects.completion",
                "projects.fee"
            )
            ->orderBy("projects.created_at", "desc")->get();
            return response()->json($projects);
        }else{
            $projects =
            DB::table("projects")
            ->join("users", "projects.Assmanager", "=", "users.id")
            ->select(
                "projects.id",
                "projects.title",
                "projects.client",
                "projects.desc",
                "projects.status",
                "users.name",
                "projects.Assmanager",
                "projects.commencement",
                "projects.completion"
            )
            ->orderBy("projects.created_at", "desc")->get();
            return response()->json($projects);
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

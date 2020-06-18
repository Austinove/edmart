<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpencesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application expences.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('finance.expences');
    }
    public function create(Request $request)
    {
        return $request;
        // return response()->json([
        //     "msg" => $request
        // ]);
    }
}

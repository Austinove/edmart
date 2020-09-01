<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'userType' => ['required', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image' => $data['image'],
            'password' => Hash::make('password'),
            'userType' => $data['userType'],
            'position' => $data['position'],
            'status' => 1
        ]);
    }

    public function editUserInfo(Request $request){
        $this->validate($request, [
            "name" => "required",
            "email" => "required"
        ]);
        $inputs = $request->all();
        if ($request->file("image")) {
            $this->validate($request, [
                "image" => "image|max:2000|mimes:jpeg,png,jpg",
            ]);
            $file = $request->file("image");
            $nameWithExt = $file->getClientOriginalName();
            $name = pathinfo($nameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $saveName = $name . "_" . time() . "." . $extension;
            $file->move("profiles", $saveName);
            $inputs["image"] = $saveName;
            try {
                if(Auth::user()->image !== "default.jpg"){
                    File::delete('profiles/'.Auth::user()->image);
                }
                User::where("id", "=", Auth::user()->id)->update([
                    "name" => $inputs["name"],
                    "email" => $inputs["email"],
                    "image" => $saveName
                ]);
                return response()->json(["msg" => "Saved Successfully"]);
            } catch (QueryException $th) {
                throw $th;
            }
        }
        try {
            User::where("id", "=", Auth::user()->id)->update([
                "name" => $inputs["name"],
                "email" => $inputs["email"]
            ]);
            return response()->json(["msg" => "Saved Successfully"]);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function editUserPassword(Request $request)
    {
        $inputs = $request->all();
        $this->validate($request, [
            "password" => "required"
        ]);
        try {
            User::where("id", "=", Auth::user()->id)->update([
                'password' => Hash::make($inputs['password'])
            ]);
            Auth::logout();
            Session::flush();
            return response()->json(["msg" => "Password Updated"]);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    public function fetchUsers() 
    {
        $users = DB::table('users')
            ->whereIn('userType', ["worker", "hr"])
            ->get();
        return response()->json($users);
    }

    public function userActions(Request $request)
    {
        $inputs = $request->all();
        //reset user password
        if($inputs["action"] === "password") {
            try {
                User::where("id", "=", $inputs["id"])->update([
                    'password' => Hash::make($inputs['action'])
                ]);
                return response()->json(["msg" => "Password Updated"]);
            } catch (QueryException $th) {
                throw $th;
            }
        } else if($inputs["action"] === "1"){
            //activation action
            try {
                User::where("id", "=", $inputs["id"])->update([
                    // 'password' => Hash::make("password"),
                    "status" => $inputs["action"]
                ]);
                return $this->fetchUsers();
            } catch (QueryException $th) {
                throw $th;
            }
        }else{
            //deactivation actions
            try {
                User::where("id", "=", $inputs["id"])->update([
                    // 'password' => Hash::make("askAdminK-DeBryan"),
                    "status" => $inputs["action"]
                ]);
                return $this->fetchUsers();
            } catch (QueryException $th) {
                throw $th;
            }
        }
        
    }
}

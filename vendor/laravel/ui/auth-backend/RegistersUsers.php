<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $inputs = $request->all();
        // setting up position
        $position = $inputs["position"];
        if($inputs["position"] == null){
            if($inputs["userType"] === "admin"){
                $position = "Managing Director";
            }else{
                $position = "Human Resource";
            }
        }
        $inputs["position"] = $position;
        $this->validator($request->all())->validate();
        if ($request->file("image")) {
            $this->validate($request, [
                "image" => "image|max:2000|mimes:jpeg,png,jpg",
            ]);
            $file = $request->file("image");
            $nameWithExt = $file->getClientOriginalName();
            $name = pathinfo($nameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $saveName = "image_".time().".".$extension;
            $file->move("profiles", $saveName);
            $inputs["image"] = $saveName;
        } else {
            $inputs["image"] = "default.jpg";
        }
        
        event(new Registered($user = $this->create($inputs)));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }
    
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return response()->json([
            "msg" => "User Registered Successfully"
        ]);
    }
}

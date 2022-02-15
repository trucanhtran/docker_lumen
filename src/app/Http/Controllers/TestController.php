<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
       
    }

    public function login(Request $request)
    {        
        $user = User::where('email' , '=', $request->email)->first();
        $user_password = base64_encode(env('APP_KEY').$request->password);
        if ($user_password == $user->password){
            $token = uniqid('token_', true);
            $user->token = $token;
            $user->save();
            return response()->json(['token' => $token, 'status' => 'success', 'message' => 'Post created successfully']);
            
        } 
    }

    public function signup(Request $request)
    {        
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = base64_encode(env('APP_KEY').$request->password);
            $token = uniqid('token_', true);
            $user->token = $token;
            if ($user->save()){
                return view('home', ['token'=>$token, 'user'=>$user]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function signout($token)
    {       
         print $token;
            $user = User::where('token' , '=', $token)->first();
            print $user;
            $user->token = "";
           $user->save();   
    }

    public function home()
    {       
        return view('home');
    }


}

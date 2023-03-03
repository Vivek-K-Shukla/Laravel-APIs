<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'tc'=>'required',
        ]);
        if(User::where('email',$request->email)->first()){
            return response([
                'message'=>'Email already exits',
                'status'=>'failed'
            ],200);
        }

        $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'tc'=>json_decode($request->tc),
        ]);
        $token = $user->createToken($request->email)->plainTextToken;
        return response([
            'token'=>$token,
            'message' => 'Registration Success',
            'status'=>'success'
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        //To check requested email & password is stored in database or not.if exits then fetch first email.
        $user = User::where('email', $request->email)->first();  
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken($request->email)->plainTextToken;
            return response([
                'token'=>$token,
                'message' => 'Login Success',
                'status'=>'success'
            ], 200);
        }
        return response([
            'message' => 'The Provided Credentials are incorrect',
            'status'=>'failed'
        ], 401);
    }

    public function logout(){
        //getting users token by using auth() function & simply delete token to logout.
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout Success',
            'status'=>'success'
        ], 200);
    }

    public function logged_user(){
        //Getting logged User Data.
        $loggeduser = auth()->user();
        return response([
            'user'=>$loggeduser,
            'message' => 'Logged User Data',
            'status'=>'success'
        ], 200);
    }

    public function change_password(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        //Getting logged user password by using auth() function and simply change & save password.
        $loggeduser = auth()->user();
        $loggeduser->password = Hash::make($request->password);
        $loggeduser->save();
        return response([
            'message' => 'Password Changed Successfully',
            'status'=>'success'
        ], 200);
    }
}
    


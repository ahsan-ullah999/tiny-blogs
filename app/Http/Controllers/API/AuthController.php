<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validation = $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);
        $users = User::create($validation);
        $token = $users->createToken($request->name);
        return[
            'user'=>$users,
            'token'=> $token->plainTextToken,
        ];


    }

    public function login(Request $request){
        $request->validate([
             'email'=>'required|email|exists:users',
             'password'=>'required',
        ]);
        $users = User::where('email', $request->email)->first();
        if(!$users || !Hash::check($request->password, $users->password)){
            return[
                'message'=>'The provided credentials are incorrect',
            ];

        }
        $token = $users->createToken($users->name);
        return[
            'user'=>$users,
            'token'=> $token->plainTextToken,
        ];

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return [
            'message'=>'you are logged out',
        ];
    }

}

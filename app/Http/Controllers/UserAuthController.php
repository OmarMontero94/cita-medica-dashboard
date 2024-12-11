<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserPostRequest;
use App\Http\Requests\RegisterUserPostRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class UserAuthController extends Controller
{
    
    public function register(RegisterUserPostRequest $request){
        $registerUserData = $request->input();
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return response()->json([
            'message' => 'User Created',
        ], Response::HTTP_OK );
    }

    public function login(LoginUserPostRequest $request){
        $loginUserData = $request->input();
        $user = User::where('email',$loginUserData['email'])->first();
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return response()->json([
        "message"=>"logged out"
        ]);
    }

}

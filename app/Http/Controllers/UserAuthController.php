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
    
    public function login(LoginUserPostRequest $request){
        $credentials = $request->input();
        
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],Response::HTTP_UNAUTHORIZED);
        }
        
        $user = Auth::user();
        $token = $user->createToken($user->email.'--AuthToken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request){
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
        "message"=>"logged out"
        ]);
    }

}

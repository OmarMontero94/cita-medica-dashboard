<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserPostRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


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

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //login
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //check if user exist
        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        //check password
       if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'Incorrect password',
            ], 401);
       }

       //generate token
       $token = $user->createToken('auth-token')->plainTextToken;

       return response()->json([
           'status' => 'success',
           'token' => $token,
           'user' => $user,
       ], 200);
    }
}

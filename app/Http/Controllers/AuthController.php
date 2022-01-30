<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Models\User;

class AuthController extends Controller
{
    /*
     * Login API
     * 
     */
    public function login(Request $request) 
    {
        $validated = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($validated)){

            // create access token for user 
            $token = Auth::user()->createToken('Laboratory')->accessToken;

            return response()->json(['token' => $token], 200);
        } 

        return response()->json(['error' => 'Unauthorised'], 401);
    } 
}

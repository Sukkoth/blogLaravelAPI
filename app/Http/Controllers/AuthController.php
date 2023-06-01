<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => 'required',
            "password" => 'required',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return response()->json([
                "status" => "failed",
                "message" => "Incorrect Credentials "
            ], 401);

        $token = Auth::user()->createToken(Auth::user()->email);
        return response()->json([
            "user" => Auth::user(),
            "accessToken" => Auth::user()->createToken('myApp')->accessToken
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            "user_name" => 'required|min:6|max:255',
            "email" => 'required|unique:users',
            "password" => 'required|min:6|max:255',
            "phone" => 'required'
        ]);


        $user = User::create([
            "user_name" => $request->input('user_name'),
            "password" => Hash::make($request->input('password')),
            "email" => $request->input('email'),
            "phone" => $request->input('phone')
        ]);

        return response()->json([
            "user" => $user,
            "accessToken" => $user->createToken('myApp')->accessToken
        ], 201);
    }

    public function details(Request $request)
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }
}
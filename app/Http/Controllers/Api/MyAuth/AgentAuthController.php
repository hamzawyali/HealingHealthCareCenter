<?php

namespace App\Http\Controllers\Api\MyAuth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentAuthController extends Controller
{
    public function register(Request $request)
    {
        //check data
        $validatedData = $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);


        return response([
            'user' => $user,
        ]);
    }

    public function login(Request $request)
    {
        //check data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // login
        if (!auth()->attempt($validatedData))
            return response([
                'message' => 'Invalid credentials'
            ]);

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'user' => auth()->user(),
            'access_token' => $accessToken
        ]);
    }
}

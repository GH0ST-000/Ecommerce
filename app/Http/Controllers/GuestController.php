<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class GuestController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateUserRequest($request);

        $this->createUser($request);

        return response()->json([
            'message' => 'User registered successfully',
        ], 201);
    }

    private function validateUserRequest(Request $request): void
    {
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'role' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
    }

    private function createUser(Request $request): void
    {
        $user = new User([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        $user->save();
    }
}

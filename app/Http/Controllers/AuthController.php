<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register (UserRegisterRequest $request) : JsonResponse {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return response()->json([
            'success' => true,
            'message' => 'User Created',
            'data' => new UserResource($user),
            'access_token' => $user->createToken('API TOKEN')->plainTextToken
        ], 201);
    }

    public function login (UserLoginRequest $request) : JsonResponse {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or password do not match with our records',
            ], 400);
        }

        $user = User::where('email', $request->email)->first();
        
        return response()->json([
            'success' => true,
            'message' => 'User logged in',
            'data' => new UserResource($user),
            'access_token' => $user->createToken('API TOKEN')->plainTextToken
        ]);
    }
}

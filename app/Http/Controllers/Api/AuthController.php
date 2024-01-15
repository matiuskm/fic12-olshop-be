<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request): JsonResponse
    {
        // Validate the request...
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'email|required|unique:users',
            'phone' => 'required|max:15',
            'password' => 'required'
        ]);

        // Create user
        $validatedData['password'] = Hash::make($request->password);
        $user = User::create($validatedData);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json(['user' => $user, 'access_token' => $token], 201);
    }

    public function login(Request $request): JsonResponse
    {
        // Validate the request...
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // Check email
        $user = User::where('email', $validatedData['email'])->first();

        // Check password
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json(['user' => $user, 'access_token' => $token], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        // Revoke token
        $request->user()->currentAccessToken()->delete();

        // Return response
        return response()->json(['message' => 'Logged out'], 200);
    }
}

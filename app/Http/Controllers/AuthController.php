<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function register(Request $request)
{
     try {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return response()->json([
        'status' => 'success',
        'token' => $user->createToken('api-token')->plainTextToken
    ], 201);
    // $request->validate([
    //     'name' => 'required',
    //     'email' => 'required|email|unique:users',
    //     'password' => 'required|min:6',
    // ]);

    // $user = User::create([
    //     'name' => $request->name,
    //     'email' => $request->email,
    //     'password' => bcrypt($request->password),
    // ]);

    // return response()->json(['token' => $user->createToken('api-token')->plainTextToken]);
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = Auth::user()->createToken('api-token')->plainTextToken;
    return response()->json(['token' => $token]);
}

public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out']);
}
}

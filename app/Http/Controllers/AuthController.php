<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json(['error' => ['Mật khẩu hoặc tên đăng nhập sai'] ], 401);
        }

        $token = $user->createToken($user->username);

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ]);

    }
   
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logged out']);
    }
   
    public function register(Request $request) {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

    }
    
}

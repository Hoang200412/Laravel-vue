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
            return response()->json(['errors' => [
                'password' => ['Tên đăng nhập hoặc mật khẩu không đúng'],
            ]], 401);
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

    public function getProfile() {
        return response()->json(auth()->user(), 200);
    }
    
}

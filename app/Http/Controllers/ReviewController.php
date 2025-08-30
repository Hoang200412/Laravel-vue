<?php

namespace App\Http\Controllers;

use App\Models\Proof;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ReviewController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('IsAdmin')
        ];
    }

    public function index()
    {
        $Proof = Proof::query()
        ->join('users', 'users.id', '=', 'proofs.user_id')
        ->select('proofs.*', 'users.name as author')
        ->get();
        return response()->json($Proof, 200);
    }

    public function show(Proof $proof) {
        $proof = $proof->query()
        ->join('users', 'users.id', '=', 'proofs.user_id')
        ->select('proofs.*', 'users.name as author')
        ->first();
        if (!$proof) {
            return response()->json(['message' => 'Proof not found'], 404);
        }
        return response()->json($proof, 200);
    }

    
}

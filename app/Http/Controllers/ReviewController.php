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
        ->latest()
        ->get();
        return response()->json($Proof, 200);
    }

    public function show(Proof $review) {
        $proof = $review->query()
        ->join('users', 'users.id', '=', 'proofs.user_id')
        ->select('proofs.*', 'users.name as author')
        ->where('proofs.id', $review->id)
        ->first();
        if (!$proof) {
            return response()->json(['message' => 'Proof not found'], 404);
        }
        return response()->json($proof, 200);
    }

    public function update(Request $request, Proof $review) {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);
        try {
            $review->status = $validated['status'];
            $review->save();
            return response()->json(['message' => 'Duyệt thành công'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to update proof status',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    
}

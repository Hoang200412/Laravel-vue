<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminController extends Controller implements HasMiddleware
{

    public static function middleware() {
        return [
            new Middleware('auth:sanctum')
        ];
    }
     
    public function getProofs()
    {
        $Proof = Proof::query()
        ->join('users', 'users.id', '=', 'proofs.user_id')
        ->select('proofs.*', 'users.name as author', )
        ->get();
        return response()->json($Proof, 200);
    }


}

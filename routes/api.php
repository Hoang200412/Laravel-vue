<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\ProductController;


Route::resource('products', ProductController::class);
Route::resource('proof', ProofController::class);
Route::resource('users', UserController::class);
Route::get('proof/signed-url/{proof}',[FileController::class, 'getSignedUrl']);
Route::get('/proofs/dashboard-stats', [ProofController::class, 'dashboardStats']);
Route::get('/proofs/top-authors', [ProofController::class, 'topAuthors']);


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');   
Route::post('register', [AuthController::class, 'register']);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;


Route::resource('products', ProductController::class);
Route::resource('proofs', ProofController::class);
Route::resource('users', UserController::class);
Route::resource('reviews', ReviewController::class);

Route::get('proof/signed-url/{proof}',[FileController::class, 'getSignedUrl']);
Route::get('/proof/dashboard-stats', [ProofController::class, 'dashboardStats']);
Route::get('/proof/top-authors', [ProofController::class, 'topAuthors']);
Route::get('profile', [ProfileController::class, 'getProfile'])->middleware('auth:sanctum');




Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');   
Route::post('register', [AuthController::class, 'register']);
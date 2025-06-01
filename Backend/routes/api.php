<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\AuthController;

// Login & Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Cek user login
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// ✅ Public Routes (READ ONLY for Everyone)
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);


// ✅ Admin Routes (Protected)
Route::middleware(['auth:api', 'is_admin'])->group(function () {
    Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);
    Route::apiResource('genres', GenreController::class)->except(['index', 'show']);
    Route::apiResource('books', BookController::class);
});

Route::middleware(['auth:api', 'is_admin'])->group(function () {
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
    Route::get('/transactions', [TransactionController::class, 'index']);
});

Route::middleware(['auth:api', 'is_customer'])->group(function () {
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);
    Route::put('/transactions/{id}', [TransactionController::class, 'update']);
});


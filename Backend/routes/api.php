<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\API\TransactionItemController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CategoryController;

// Login & Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('books', BookController::class);
Route::apiResource('carts', CartController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('transaction-items', TransactionItemController::class);
Route::apiResource('transactions', TransactionController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('categories', CategoryController::class);


// Cek user login
Route::middleware('auth:api')->group(function () {
    Route::apiResource('/users', UserController::class);
}); // <-- Ini adalah penutup yang hilang!


// ✅ Public Routes (READ ONLY for Everyone)
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);


// ✅ Admin Routes (Protected)
Route::middleware(['auth:api', 'is_admin'])->group(function () {
    Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);
    Route::apiResource('genres', GenreController::class)->except(['index', 'show']);

});



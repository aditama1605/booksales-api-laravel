<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\UserController;





Route::get('/login', function () {
    return view('login'); // ⬅️ pastikan kamu punya resources/views/login.blade.php
})->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::view('/register', 'register');
Route::get('/', function () {
    return view('home');
});

Route::get('/books', [BookPageController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookPageController::class, 'show'])->name('books.show');


Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/add/{bookId}', [CartController::class, 'add']);
Route::post('/cart/update/{bookId}', [CartController::class, 'update']);
Route::delete('/cart/delete/{bookId}', [CartController::class, 'delete']);
Route::post('/cart/add/{bookId}', [CartController::class, 'add']);

Route::get('/about', function () {
    return view('about');
});

// routes/web.php
Route::view('/contact', 'contact')->name('contact');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::prefix('admin')->group(function () {
    Route::resource('/books', BookController::class)->except(['show', 'edit', 'update']);
});

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});


Route::prefix('admin')->group(function () {
    Route::get('/orders', function () {
        return view('admin.orders');
    });
});

Route::view('/checkout', 'checkout');

Route::prefix('admin')->group(function () {
    Route::view('/categories', 'admin.categories');
});




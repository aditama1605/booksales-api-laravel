<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/library', [LibraryController::class, 'index']);
Route::get('/books', [BookController::class, 'index']);

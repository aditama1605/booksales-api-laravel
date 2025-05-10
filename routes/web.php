<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/library', [LibraryController::class, 'index']);
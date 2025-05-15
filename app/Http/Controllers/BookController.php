<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Ambil semua buku beserta relasi author-nya
        $books = Book::with('author')->get();

        // Kirim data ke view books/index.blade.php
        return view('books.index', compact('books'));
    }
}

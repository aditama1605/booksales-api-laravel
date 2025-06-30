<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookPageController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['author', 'genre']);

        // Filter by keyword
        if ($request->has('q') && $request->q !== '') {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $books = $query->paginate(12);

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with(['author', 'genre'])->findOrFail($id);

        return view('books.detail', compact('book'));
    }
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genre'])->get();
        $genres = Genre::all();
        $authors = Author::all();

        return view('admin.books', compact('books', 'genres', 'authors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|string',
            'genre_id' => 'required|integer|exists:genres,id',
            'author_id' => 'required|integer|exists:authors,id',
        ]);

        Book::create($data);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }
}

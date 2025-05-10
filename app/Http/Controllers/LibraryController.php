<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Author;

class LibraryController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $authors = Author::all();

        return view('library', compact('genres', 'authors'));
    }
}

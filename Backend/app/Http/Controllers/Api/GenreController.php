<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        return response()->json(Genre::all());
    }

    public function store(Request $request) {
        $genre = Genre::create($request->validate(['name' => 'required']));
        return response()->json($genre, 201);
    }

    public function show($id) {
        return response()->json(Genre::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $genre = Genre::findOrFail($id);
        $genre->update($request->validate(['name' => 'required']));
        return response()->json($genre);
    }

    public function destroy($id) {
        Genre::destroy($id);
        return response()->json(null, 204);
    }
}

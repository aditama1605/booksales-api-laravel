<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json(
            Cart::with('book')->where('user_id', $user->id)->get()
        );
    }

    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::updateOrCreate(
            ['user_id' => $user->id, 'book_id' => $validated['book_id']],
            ['quantity' => $validated['quantity']]
        );

        return response()->json($cart, 201);
    }

    public function show(Cart $cart)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($cart->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($cart->load('book'));
    }

    public function update(Request $request, Cart $cart)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($cart->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update($validated);

        return response()->json($cart);
    }

    public function destroy(Cart $cart)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($cart->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $cart->delete();

        return response()->json(null, 204);
    }
}

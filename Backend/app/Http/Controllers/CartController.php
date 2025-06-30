<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $books = Book::whereIn('id', array_keys($cart))->get();

        $items = [];
        $total = 0;

        foreach ($books as $book) {
            $qty = $cart[$book->id];
            $subtotal = $book->price * $qty;
            $items[] = [
                'book' => $book,
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];
            $total += $subtotal;
        }

        return view('cart', compact('items', 'total'));
    }

    public function add($bookId)
    {
        $cart = session()->get('cart', []);

        // Jika sudah ada
        if (isset($cart[$bookId])) {
            $cart[$bookId]++;
        } else {
            $cart[$bookId] = 1;
        }

        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Buku ditambahkan ke keranjang!');
    }

    public function update(Request $request, $bookId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $cart[$bookId] = $request->quantity;
        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Jumlah buku diperbarui.');
    }

    public function delete($bookId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$bookId]);
        session()->put('cart', $cart);

        return redirect('/cart')->with('success', 'Item dihapus dari keranjang.');
    }
}

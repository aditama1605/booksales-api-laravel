<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $this->authorizeRole('admin');

        $transactions = Transaction::with(['customer', 'book'])->get();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $this->authorizeRole('customer');

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'total_amount' => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'order_number' => uniqid('ORD-'),
            'customer_id' => Auth::id(),
            'book_id' => $validated['book_id'],
            'total_amount' => $validated['total_amount'],
        ]);

        return response()->json($transaction, 201);
    }

    public function show($id)
    {
        $this->authorizeRole('customer');

        $transaction = Transaction::with(['customer', 'book'])
            ->where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        return response()->json($transaction);
    }

    public function update(Request $request, $id)
    {
        $this->authorizeRole('customer');

        $transaction = Transaction::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'book_id' => 'sometimes|exists:books,id',
            'total_amount' => 'sometimes|numeric',
        ]);

        $transaction->update($validated);

        return response()->json($transaction);
    }

    public function destroy($id)
    {
        $this->authorizeRole('admin');

        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }

    protected function authorizeRole($role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return true;
        }

        abort(403, 'Access denied');
    }
}

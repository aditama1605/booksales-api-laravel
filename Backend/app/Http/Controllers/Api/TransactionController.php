<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransactionController extends Controller
{
    // 📌 Lihat semua transaksi (hanya admin)
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transactions = Transaction::with(['customer', 'book'])->get();

        return response()->json([
            'message' => 'Daftar semua transaksi',
            'data' => $transactions,
        ]);
    }

    // 📌 Buat transaksi (user)
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || $user->role !== 'user') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::create([
            'order_number' => strtoupper(uniqid('ORD-')),
            'customer_id' => $user->id,
            'book_id' => $validated['book_id'],
            'total_amount' => $validated['total_amount'],
        ]);

        $transaction->load(['customer', 'book']);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaction,
        ], 201);
    }

    // 📌 Lihat transaksi milik sendiri (user)
    public function show($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || $user->role !== 'user') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transaction = Transaction::with(['customer', 'book'])
            ->where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail transaksi',
            'data' => $transaction,
        ]);
    }

    // 📌 Update transaksi milik sendiri (user)
    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || $user->role !== 'user') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transaction = Transaction::where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'book_id' => 'sometimes|exists:books,id',
            'total_amount' => 'sometimes|numeric|min:0',
        ]);

        $transaction->update($validated);
        $transaction->load(['customer', 'book']);

        return response()->json([
            'message' => 'Transaksi diperbarui',
            'data' => $transaction,
        ]);
    }

    // 📌 Admin hapus transaksi
    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}

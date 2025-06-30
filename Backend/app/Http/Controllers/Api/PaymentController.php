<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentController extends Controller
{
    // List semua payment milik user yang sedang login
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payments = Payment::where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }

    // Tampilkan payment spesifik
    public function show($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payment = Payment::where('user_id', $user->id)->find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment tidak ditemukan atau bukan milik Anda.'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $payment,
        ]);
    }

    // Simpan payment baru
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'total_amount'     => 'required|numeric',
            'delivery_address' => 'required|string',
            'status'           => 'required|string', // contoh: pending, paid, failed
        ]);

        $payment = Payment::create([
            'user_id'          => $user->id,
            'total_amount'     => $request->total_amount,
            'delivery_address' => $request->delivery_address,
            'status'           => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'data' => $payment,
            'message' => 'Payment berhasil dibuat.'
        ], 201);
    }

    // Update payment
    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payment = Payment::where('user_id', $user->id)->find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment tidak ditemukan atau bukan milik Anda.'], 404);
        }

        $request->validate([
            'total_amount'     => 'sometimes|numeric',
            'delivery_address' => 'sometimes|string',
            'status'           => 'sometimes|string',
        ]);

        $payment->update($request->only(['total_amount', 'delivery_address', 'status']));

        return response()->json([
            'success' => true,
            'data' => $payment,
            'message' => 'Payment berhasil diupdate.'
        ]);
    }

    // Hapus payment
    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payment = Payment::where('user_id', $user->id)->find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment tidak ditemukan atau bukan milik Anda.'], 404);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment berhasil dihapus.'
        ]);
    }
}

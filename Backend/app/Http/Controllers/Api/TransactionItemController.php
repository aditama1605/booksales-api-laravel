<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class TransactionItemController extends Controller
{
    public function index()
    {
        return response()->json(TransactionItem::with(['book', 'transaction'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        $item = TransactionItem::create($validated);
        return response()->json($item, 201);
    }

    public function show(TransactionItem $transactionItem)
    {
        return response()->json($transactionItem->load(['book', 'transaction']));
    }

    public function update(Request $request, TransactionItem $transactionItem)
    {
        $validated = $request->validate([
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric',
        ]);

        $transactionItem->update($validated);
        return response()->json($transactionItem);
    }

    public function destroy(TransactionItem $transactionItem)
    {
        $transactionItem->delete();
        return response()->json(null, 204);
    }
}

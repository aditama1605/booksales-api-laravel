<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $userCount = User::count();
        $orderCount = Transaction::count();

        $today = Carbon::today();

        // Hitung total pendapatan hari ini dari TransactionItem
        $revenueToday = TransactionItem::whereHas('transaction', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->get()->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('admin.dashboard', [
            'bookCount'    => $bookCount,
            'userCount'    => $userCount,
            'orderCount'   => $orderCount,
            'revenueToday' => $revenueToday,
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'book_id',
        'quantity',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}


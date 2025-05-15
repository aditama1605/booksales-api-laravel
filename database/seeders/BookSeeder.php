<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::insert([
            ['title' => 'Harry Potter', 'author_id' => 1, 'year' => 1997],
            ['title' => '1984', 'author_id' => 2, 'year' => 1949],
            ['title' => 'The Shining', 'author_id' => 3, 'year' => 1977],
            ['title' => 'Pride and Prejudice', 'author_id' => 4, 'year' => 1813],
            ['title' => 'Kafka on the Shore', 'author_id' => 5, 'year' => 2002],
        ]);
    }
}

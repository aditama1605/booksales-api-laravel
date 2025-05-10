<?php

namespace App\Models;

class Genre
{
    public static function all()
    {
        return [
            ['id' => 1, 'name' => 'Science Fiction'],
            ['id' => 2, 'name' => 'Fantasy'],
            ['id' => 3, 'name' => 'Mystery'],
            ['id' => 4, 'name' => 'Romance'],
            ['id' => 5, 'name' => 'Horror'],
        ];
    }
}

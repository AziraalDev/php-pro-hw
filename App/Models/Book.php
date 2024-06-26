<?php

namespace App\Models;

use Core\Model;

class Book extends Model
{
    protected static string|null $tableName = 'books';

    # Not to get Warnings - we can't create vars dynamically
    public int $id;
    public string $name;
    public ?string $description, $isbn, $published_date, $created_at, $updated_at;
}
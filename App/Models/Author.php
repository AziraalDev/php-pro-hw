<?php

namespace App\Models;

use Core\Model;

class Author extends Model
{
    protected static string|null $tableName = 'authors';

    # Not to get Warnings - we can't create vars dynamically
    public int $id;
    public string $name;
    public ?string $biography, $birth_date, $created_at, $updated_at;
}
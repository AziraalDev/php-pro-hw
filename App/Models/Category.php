<?php

namespace App\Models;

use Core\Model;

class Category extends Model
{
    protected static string|null $tableName = 'categories';

    # Not to get Warnings - we can't create vars dynamically
    public int $id;
    public string $name;
    public ?string $description, $created_at, $updated_at;
}
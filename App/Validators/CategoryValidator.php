<?php

namespace App\Validators;

use App\Enums\SQL;
use App\Models\Category;

class CategoryValidator extends BaseValidator
{
    protected static array $rules = [
        // only words started with capital char
        'name' => '/^[A-Z][a-zA-Z]*$/u'
    ];

    protected static array $errors = [
        'name' => 'Category name should starting with capital char'
    ];

    public static function validate(array $fields = []): bool
    {
        $result = [
            parent::validate($fields),
            !static::checkOnDuplicate($fields['name'])
        ];

        return !in_array(false, $result);
    }

    protected static function checkOnDuplicate(string $name): bool
    {
        $result = Category::where('name', SQL::EQUAL, $name)
            ->exists();

        if ($result) {
            static::setErrors('name', "The category with name [$name] already exists!");
        }

        return $result;
    }
}
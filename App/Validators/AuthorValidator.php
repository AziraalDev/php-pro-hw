<?php

namespace App\Validators;

use App\Enums\SQL;
use App\Models\Author;

class AuthorValidator extends BaseValidator
{
    protected static array $rules = [
        // only words started with capital char
        'name' => '/^[A-Z][a-]*((\s[A-Z][a-z]*)*)$/'
    ];

    protected static array $errors = [
        'name' => 'Author name should contain only characters and each word from capital char'
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
        $result = Author::where('name', SQL::EQUAL, $name)
                        ->exists();

        if ($result) {
            static::setErrors('name', "The author with name [$name] already exists!");
        }

        return $result;
    }
}
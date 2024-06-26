<?php

namespace App\Validators;

use App\Enums\SQL;
use App\Models\Book;

class BookValidator extends BaseValidator
{
    protected static array $rules = [
        // only words started with capital char
        'title' => '/^[A-Z][a-zA-Z0-9\-\'\s]*$/u'
    ];

    protected static array $errors = [
        'title' => 'Book title should starting with capital char'
    ];

    public static function validate(array $fields = []): bool
    {
        $result = [
            parent::validate($fields),
            !static::checkOnDuplicate($fields['title'])
        ];

        return !in_array(false, $result);
    }

    protected static function checkOnDuplicate(string $title): bool
    {
        $result = Book::where('title', SQL::EQUAL, $title)
            ->exists();

        if ($result) {
            static::setErrors('title', "The book with title [$title] already exists!");
        }

        return $result;
    }
}
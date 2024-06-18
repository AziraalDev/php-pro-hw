<?php

namespace App\Validators\Auth;

class AuthValidator extends Base
{
    const string DEFAULT_MESSAGE = 'Email or password is incorrect';
    static protected array $error = [
        'email' => self::DEFAULT_MESSAGE,
        'password' => self::DEFAULT_MESSAGE
    ];

    static public function validate(array $fields = []): bool
    {
        $result = [
            parent::validate($fields),
            static::checkEmailExisting($fields['email'], false, self::DEFAULT_MESSAGE)
        ];
        return !in_array(false, $result);
    }
}
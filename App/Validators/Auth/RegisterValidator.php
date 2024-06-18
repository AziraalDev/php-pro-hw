<?php

namespace App\Validators\Auth;

class RegisterValidator extends Base
{
    static protected array $error = [
        'email' => 'Email is incorrect',
        'password' => 'Password is incorrect. Min length is 8 symbols'
    ];

    static public function validate(array $fields = []): bool
    {
        $result = [
            parent::validate($fields),
            !static::checkEmailExisting($fields['email'])
            ];

        return !in_array(false, $result);
    }
}
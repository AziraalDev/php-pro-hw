<?php

namespace Core;

use App\Enums\HttpStatus;

abstract class Controller
{
    public function before(string $action, array $params = []): bool
    {
        // Invocable before ACTION
        return true;
    }

    public function after(string $action): void
    {
        // Invocable after ACTION
    }

    protected function response(HttpStatus $status, array $body = [], array $errors = []): array
    {
        return compact('status', 'body', 'errors');
    }
}
<?php

namespace Core\Traits;

use App\Enums\Method;

trait HttpMethods
{
    public static function get(string $uri): static
    {
        return static::setUri($uri)->setMethod(Method::GET);
    }
    public static function put(string $uri): static
    {
        return static::setUri($uri)->setMethod(Method::PUT);
    }
    public static function post(string $uri): static
    {
        return static::setUri($uri)->setMethod(Method::POST);
    }
    public static function delete(string $uri): static
    {
        return static::setUri($uri)->setMethod(Method::DELETE);
    }
}
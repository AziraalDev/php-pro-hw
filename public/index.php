<?php

use App\Enums\HttpStatus as HttpStatus;
use Core\Router as Router;
use Dotenv\Dotenv;

#parent directory of "public" -> html
define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . "/vendor/autoload.php";

try {
    $dotenv = Dotenv::createUnsafeImmutable(BASE_DIR);

    die(Router::dispatch($_SERVER['REQUEST_URI']));
} catch (Throwable $exception) {
    die(jsonResponse(
        HttpStatus::from($exception->getCode()),
        ['errors' => [
            'message' => $exception->getMessage(),
        ]]
    ));
}


<?php

use App\Enums\HttpStatus as HttpStatus;
use App\Models\User;
use Core\Router as Router;
use Dotenv\Dotenv;

#parent directory of "public" -> html
define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . "/vendor/autoload.php";

try {
    $dotenv = Dotenv::createUnsafeImmutable(BASE_DIR);
    $dotenv->load();

    die(Router::dispatch($_SERVER['REQUEST_URI']));
} catch (PDOException $exception) {
    die(
    jsonResponse(
        HttpStatus::UNPROCESSABLE_ENTITY,
        [
            'errors' => [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTrace()
            ]
        ]
    )
    );
} catch (Throwable $exception) {
    dd($exception);
    die(
    jsonResponse(
        HttpStatus::from($exception->getCode()),
        ['errors' => [
            'message' => $exception->getMessage(),
        ]]
    ));
}


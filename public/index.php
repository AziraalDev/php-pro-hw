<?php

use App\Enums\HttpStatus as HttpStatus;
use Core\Router as Router;

#parent directory of "public" -> html
define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . "/vendor/autoload.php";

try {
    die(Router::dispatch($_SERVER['REQUEST_URI']));
} catch (Throwable $exception) {
    die(jsonResponse(
        HttpStatus::from($exception->getCode()),
        ['errors' => [
            'message' => $exception->getMessage(),
        ]]
    ));
}


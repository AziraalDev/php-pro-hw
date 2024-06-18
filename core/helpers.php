<?php

use App\Enums\HttpStatus as Status;
use Core\DB;

function db(): PDO
{
    return DB::connect();
}
function jsonResponse(Status $httpStatus, $data = []) : string
{
    header_remove();
    http_response_code($httpStatus->value);
    header('Content-type: application/json');
    header('Status: ' . $httpStatus->value);

    return json_encode([
        ...$httpStatus->description(),
        'data' => $data
    ]);
}

function requestBody(): array
{
    $data = [];

    $requestBody = file_get_contents('php://input');

    if (!empty($requestBody)) {
        $data = json_decode($requestBody, true);
    }

    return $data;
}
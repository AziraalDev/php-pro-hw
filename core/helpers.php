<?php

use App\Enums\HttpStatus as Status;
use Core\DB;
use ReallySimpleJWT\Token;

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

function getAuthToken(): string
{
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])) {
        throw new Exception('The request should have an auth token', 422);
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);

    if (!Token::validateExpiration($token)) {
        throw new Exception('The request should have a valid auth token', 422);
    }

    return $token;
}

function authId(): int
{
    $token = Token::getPayload(getAuthToken());
    if (empty($token['user_id'])) {
        throw new Exception('Token structure is invalid ', 422);
    }

    return $token['user_id'];
}
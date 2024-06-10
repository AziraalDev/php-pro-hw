<?php

use App\Enums\HttpStatus as Status;

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

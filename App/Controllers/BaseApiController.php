<?php

namespace App\Controllers;

use App\Enums\HttpStatus;
use Core\Controller;

class BaseApiController extends Controller
{
    public function before(string $action, array $params = []): bool
    {
        return parent::before($action, $params); // TODO replace with next:
        // token (check on expire
        // get user
        // validate token && check on expire
        // return TRUE|FALSE
    }
}
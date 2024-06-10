<?php

namespace App\Controllers\V1;

use App\Controllers\BaseApiController;
use App\Enums\HttpStatus;
use Core\Controller;

class AuthorController extends BaseApiController
{
    public function index()
    {
        return $this->response(HttpStatus::OK, ['method' => 'index']);
    }

    public function show(int $id)
    {
        return $this->response(HttpStatus::OK, ['method' => 'show',
                                                      'params' => [$id]]);
    }

    public function store()
    {
        return $this->response(HttpStatus::OK, ['method' => 'store']);
    }

    public function update(int $id)
    {
        return $this->response(HttpStatus::OK, ['method' => 'update',
                                                      'params' => [$id]]);
    }

    public function delete(int $id)
    {
        return $this->response(HttpStatus::OK, ['method' => 'delete',
                                                      'params' => [$id]]);
    }
}
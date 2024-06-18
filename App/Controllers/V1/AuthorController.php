<?php

namespace App\Controllers\V1;

use App\Controllers\BaseApiController;
use App\Enums\HttpStatus;
use App\Enums\SQL;
use App\Models\Author;
use Core\Controller;

class AuthorController extends BaseApiController
{
    public function index()
    {
        $author = Author::select(['id', 'biography'])
            ->where('id', SQL::EQUAL, 2)
            ->or('biography', SQL::EQUAL, 'Lodz, Poland')
            ->get();

        return $this->response(HttpStatus::OK, $author);
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
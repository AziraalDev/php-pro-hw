<?php

namespace App\Controllers\V1;

use App\Controllers\BaseApiController;
use App\Enums\HttpStatus;
use App\Enums\SQL;
use App\Models\Author;
use App\Validators\AuthorValidator;
use Core\Controller;

class AuthorController extends BaseApiController
{
    public function index(): array
    {
        // simple request for all Authors | sorted | ordered | filtered
        $authors = Author::where('biography', SQL::LIKE, '%England%')
            ->or('biography', SQL::LIKE, '%Poland%')
            ->orderBy('biography')
            ->get();

        return $this->response(HttpStatus::OK, $authors);
    }

    public function show(int $id): array
    {
        // Find Author by ID
        return $this->response(HttpStatus::OK, Author::find($id)->toArray());
    }

    public function store(): array
    {
        // Creating Author
        $fields = requestBody();

        // If Author is valid and could be created
        if (AuthorValidator::validate($fields) && $author = Author::create([...$fields])) {
            return $this->response(HttpStatus::OK, $author->toArray());
        }

        return $this->response(HttpStatus::OK, errors: AuthorValidator::getErrors());
    }

    public function update(int $id): array
    {
        $fields = requestBody();
        $updateFields = [
            ...$fields,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (AuthorValidator::validate($fields) && $author = $this->model->update($updateFields)) {
            return $this->response(HttpStatus::OK, $author->toArray());
        }

        return $this->response(HttpStatus::OK, errors: AuthorValidator::getErrors());
    }

    public function delete(int $id): array
    {
        // Deleting Author
        $result = Author::destroy($id);
        if (!$result) {
            return $this->response(HttpStatus::UNPROCESSABLE_ENTITY, errors: [
                'message' => 'Oops, something went wrong'
            ]);
        }
        return $this->response(HttpStatus::OK, $this->model->toArray());
    }

    protected function getModelClass(): string
    {
        return Author::class;
    }
}
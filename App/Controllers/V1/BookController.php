<?php

namespace App\Controllers\V1;

use App\Controllers\BaseApiController;
use App\Enums\HttpStatus;
use App\Enums\SQL;
use App\Models\Book;
use App\Validators\BookValidator;

class BookController extends BaseApiController
{
    public function index()
    {
        return $this->response(
            HttpStatus::OK,
            Book::where('title', SQL::LIKE, '%Potter%')
                ->orderBy([
                    'isbn' => 'DESC',
                    'created_at' => 'DESC'
                ])
                ->get());
    }

    public function show(int $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->response(HttpStatus::NOT_FOUND, errors: ['message' => 'Book not found']);
        }
        return $this->response(HttpStatus::OK, $book->find($id)->toArray());
    }

    public function store(): array
    {
        // Creating Author
        $fields = requestBody();

        // If Author is valid and could be created
        if (BookValidator::validate($fields) && $book = Book::create([...$fields])) {
            return $this->response(HttpStatus::OK, $book->toArray());
        }

        return $this->response(HttpStatus::OK, errors: BookValidator::getErrors());
    }

    public function update(int $id): array
    {
        $fields = requestBody();
        $updateFields = [
            ...$fields,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (BookValidator::validate($fields) && $book = $this->model->update($updateFields)) {
            return $this->response(HttpStatus::OK, $book->toArray());
        }

        return $this->response(HttpStatus::OK, errors: BookValidator::getErrors());
    }

    public function delete(int $id): array
    {
        $result = Book::destroy($id);

        if (!$result) {
            return $this->response(HttpStatus::UNPROCESSABLE_ENTITY, errors: [
                'message' => 'Oops, smth went wrong'
            ]);
        }

        return $this->response(HttpStatus::OK, $this->model->toArray());
    }

    protected function getModelClass(): string
    {
        return Book::class;
    }

}
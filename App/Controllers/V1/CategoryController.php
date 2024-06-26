<?php

namespace App\Controllers\V1;
use App\Controllers\BaseApiController;
use App\Enums\HttpStatus;
use App\Enums\SQL;
use App\Models\Category;
use App\Validators\CategoryValidator;

class CategoryController extends BaseApiController
{
    public function index()
    {
        // All Categories created/updated after yesterday
        return $this->response(
            HttpStatus::OK,
            Category::where('updated_at', SQL::MORE, date('Y-m-d H:i:s', strtotime('-1 day')))
                ->orderBy([
                    'name' => 'DESC'
                ])
                ->get());
    }

    public function show(int $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->response(HttpStatus::NOT_FOUND, errors: ['message' => 'Book not found']);
        }
        return $this->response(HttpStatus::OK, $category->find($id)->toArray());
    }

    public function store(): array
    {
        // Creating Author
        $fields = requestBody();

        // If Author is valid and could be created
        if (CategoryValidator::validate($fields) && $category = Category::create([...$fields])) {
            return $this->response(HttpStatus::OK, $category->toArray());
        }

        return $this->response(HttpStatus::OK, errors: CategoryValidator::getErrors());
    }

    public function update(int $id): array
    {
        $fields = requestBody();
        $updateFields = [
            ...$fields,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (CategoryValidator::validate($fields) && $category = $this->model->update($updateFields)) {
            return $this->response(HttpStatus::OK, $category->toArray());
        }

        return $this->response(HttpStatus::OK, errors: CategoryValidator::getErrors());
    }

    public function delete(int $id): array
    {
        $result = Category::destroy($id);

        if (!$result) {
            return $this->response(HttpStatus::UNPROCESSABLE_ENTITY, errors: [
                'message' => 'Oops, smth went wrong'
            ]);
        }

        return $this->response(HttpStatus::OK, $this->model->toArray());
    }

    protected function getModelClass(): string
    {
        return Category::class;
    }
}
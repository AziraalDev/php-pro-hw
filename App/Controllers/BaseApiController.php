<?php

namespace App\Controllers;

use App\Enums\HttpStatus;
use Core\Controller;
use Core\Model;
use Exception;
use App\Models\User as User;
use ReallySimpleJWT\Token;

abstract class BaseApiController extends Controller
{
    abstract protected function getModelClass(): string;
    protected ?Model $model;
    /**
     * @throws Exception
     */
    public function before(string $action, array $params = []): bool
    {
        $token = getAuthToken();
        $user = User::find(authId());

        if (!Token::validate($token, $user->password)) {
            throw new Exception('Token is invalid', 422);
        }

        $this->checkModelOwner($action, $params, $this->getModelClass());

        return true;
    }

    protected function checkModelOwner(string $action, array $params, string $modelClass): void
    {
        if (in_array($action, ['update', 'delete'])) {
            $result = call_user_func_array([$modelClass, 'find'], $params);

            if (!$result) {
                throw new Exception("Resource is not found", HttpStatus::NOT_FOUND->value);
            }

            $this->model = $result;
        }

    }
}
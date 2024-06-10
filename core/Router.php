<?php

namespace Core;

use App\Enums\Method as Method;
use App\Enums\HttpStatus as Status;
use Core\Traits\HttpMethods as HttpMethods;
use Exception;
use ReflectionMethod;

class Router
{
    use HttpMethods;

    protected static ?Router $instance = null;
    protected $routes = [], $params = [];
    protected string $currentRoute;

    protected array $convertableTypes = [
        'd' => 'int',
        '.' => 'string'
    ];

    // Singleton
    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    public function __call(string $name, array $arguments)
    {
        //
        $methodName = 'set' . ucfirst($name);

        if (!method_exists($this, $methodName)) {
            throw new Exception(__CLASS__ . ": Method [$methodName] does not exists");
        }

        $refMethod = new ReflectionMethod($this::class, $methodName);

        if ($refMethod->getReturnType() !== 'void') {
            return call_user_func_array([$this, $methodName], $arguments);
        }

        call_user_func_array([$this, $methodName], $arguments);
    }

    static protected function setUri(string $uri): static
    {
        # URI should be converted to RegExp that will help to find match
        $uri = preg_replace('/\//', '\\/', $uri);
        $uri = preg_replace('/\{([a-z_-]+):([^}]+)}/', '(?P<$1>$2)', $uri);
        $uri = "/^$uri$/i";

        $router = static::getInstance(); // getting Router
        $router->routes[$uri] = []; // our RegEx as an argument
        $router->currentRoute = $uri;

        return $router; // router to be returned
    }

    static public function dispatch(string $uri): string
    {
        $router = static::getInstance(); // updating Instance|Router

        $uri = $router->removeQueryVariables($uri);
        $uri = trim($uri, '/');

        if ($router->match($uri)) {

            $router->checkHttpMethod();
            $controller = $router->getController();

            $action = $router->getAction($controller);

            if ($controller->before($action, $router->params)) {
                $response = call_user_func_array([$controller, $action], $router->params);
                $controller->after($action);

                if ($response) {
                    return jsonResponse(
                        $response['status'],
                        [
                            'data' => $response['body'],
                            'errors' => $response['errors']
                        ]
                    );
                }
            }
        }

        return jsonResponse(
            Status::INTERNAL_SERVER_ERROR,
            [
                'data' => [],
                'errors' => [
                    'message' => 'Response is empty'
                ]
            ]
        );
    }

    protected function getAction(Controller $controller): string
    {
        $action = $this->params['action'] ?? null;

        if (!method_exists($controller, $action)) {
            throw new Exception("Action [$action] doesn't exists in [" . $controller::class . "]");
        }
        unset($this->params['action']);

        return $action;
    }

    protected function getController(): Controller
    {
        $controller = $this->params['controller'] ?? null;

        if (!class_exists($controller)) {
            throw new Exception("Controller [$controller] doesn't exists!");
        }
        unset($this->params['controller']);

        return new $controller;
    }

    protected function checkHttpMethod(): void
    {
        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if ($requestMethod !== strtolower($this->params['method'])) {
            throw new Exception("Method [$requestMethod] is not allowed for this route", 405);
        }

        unset($this->params['method']);
    }

    protected function match(string $uri): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $uri, $matches)) {
                $this->params = $this->buildParams($route, $matches, $params);
                return true;
            }
        }

        throw new \Exception(__CLASS__ . ": Route [$uri] not found", 404);
    }

    protected function buildParams(string $route, array $matches, array $params): array
    {
        preg_match_all('/\(\?P<[\w]+>\\\\?([\w\.][\+]*)\)/', $route, $types);
        $uriParams = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

        if (!empty($types)) {
            $lastKey = array_key_last($types);
            $step = 0;
            $types[$lastKey] = array_map(fn($value) => str_replace('+', '', $value), $types[$lastKey]);

            foreach ($uriParams as $key => $value) {
                settype($value, $this->convertableTypes[$types[$lastKey][$step]]);
                $params[$key] = $value;
                $step++;
            }
        }

        return $params;
    }

    protected function removeQueryVariables(string $uri): string
    {
        return preg_replace('/([\w\/\-]+)\?([\w\-\=\&\[\{\]\}\"\%22\:\+]+)/',
            '$1', $uri);
    }

    protected function setController(string $controller): static
    {
        $this->routes[$this->currentRoute]['controller'] = $controller;
        return $this;
    }

    protected function setAction(string $action)
    {
        $this->routes[$this->currentRoute]['action'] = $action;
    }
    protected function setMethod(Method $method): static
    {
        $this->routes[$this->currentRoute]['method'] = $method->value;
        return $this;
    }

}


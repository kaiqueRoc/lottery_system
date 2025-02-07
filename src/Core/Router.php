<?php

namespace Core;

namespace Core;

class Router
{
    private array $routes = [];

    public function addRoute($method, $path, $callback): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback,
        ];
    }

    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                $callback = $route['callback'];
                return call_user_func($callback);
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
        return null;
    }
}

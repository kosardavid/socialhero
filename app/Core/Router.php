<?php
namespace App\Core;

class Router
{
    private array $routes = [];
    private string $basePath = '';

    public function __construct(string $basePath = '')
    {
        $this->basePath = rtrim($basePath, '/');
    }

    public function get(string $path, callable|array $handler): self
    {
        $this->addRoute('GET', $path, $handler);
        return $this;
    }

    public function post(string $path, callable|array $handler): self
    {
        $this->addRoute('POST', $path, $handler);
        return $this;
    }

    private function addRoute(string $method, string $path, callable|array $handler): void
    {
        // Build full path with base
        if ($path === '/') {
            $fullPath = $this->basePath ?: '/';
        } else {
            $fullPath = $this->basePath . '/' . ltrim($path, '/');
        }
        $fullPath = rtrim($fullPath, '/') ?: '/';

        // Convert route parameters to regex
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $fullPath);
        $pattern = '#^' . $pattern . '/?$#'; // Allow optional trailing slash

        $this->routes[] = [
            'method' => $method,
            'path' => $fullPath,
            'pattern' => $pattern,
            'handler' => $handler
        ];
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                if (is_callable($route['handler'])) {
                    call_user_func_array($route['handler'], $params);
                } elseif (is_array($route['handler'])) {
                    [$controller, $action] = $route['handler'];
                    $controllerInstance = new $controller();
                    call_user_func_array([$controllerInstance, $action], $params);
                }
                return;
            }
        }

        // 404 Not Found
        http_response_code(404);
        require BASE_PATH . '/app/Views/errors/404.php';
    }
}

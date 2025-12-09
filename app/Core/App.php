<?php
namespace App\Core;

class App
{
    private Router $router;
    private array $config;

    public function __construct()
    {
        $this->config = require BASE_PATH . '/config/app.php';

        // Set timezone
        date_default_timezone_set($this->config['timezone']);

        // Error handling
        if ($this->config['debug']) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        } else {
            error_reporting(0);
            ini_set('display_errors', '0');
        }

        // Initialize router
        $this->router = new Router($this->config['base_path']);
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function getConfig(string $key = null): mixed
    {
        if ($key === null) {
            return $this->config;
        }

        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return null;
            }
            $value = $value[$k];
        }

        return $value;
    }

    public function run(): void
    {
        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Dispatch router
        $this->router->dispatch();
    }
}

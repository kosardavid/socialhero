<?php
namespace App\Core;

class View
{
    private static array $data = [];
    private static ?string $layout = 'main';

    public static function render(string $view, array $data = [], ?string $layout = null): void
    {
        self::$data = array_merge(self::$data, $data);
        self::$layout = $layout ?? self::$layout;

        // Extract data to variables
        extract(self::$data);

        // Get config
        $config = require BASE_PATH . '/config/app.php';

        // Start output buffering
        ob_start();

        // Include the view file
        $viewPath = BASE_PATH . '/app/Views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            throw new \Exception("View not found: {$view}");
        }

        $content = ob_get_clean();

        // If layout is set, wrap content in layout
        if (self::$layout) {
            $layoutPath = BASE_PATH . '/app/Views/layouts/' . self::$layout . '.php';
            if (file_exists($layoutPath)) {
                require $layoutPath;
            } else {
                echo $content;
            }
        } else {
            echo $content;
        }
    }

    public static function partial(string $partial, array $data = []): void
    {
        extract(array_merge(self::$data, $data));

        $partialPath = BASE_PATH . '/app/Views/partials/' . $partial . '.php';
        if (file_exists($partialPath)) {
            require $partialPath;
        }
    }

    public static function setLayout(?string $layout): void
    {
        self::$layout = $layout;
    }

    public static function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    public static function asset(string $path): string
    {
        $config = require BASE_PATH . '/config/app.php';
        return $config['base_path'] . '/assets/' . ltrim($path, '/');
    }

    public static function url(string $path = ''): string
    {
        $config = require BASE_PATH . '/config/app.php';
        return $config['base_path'] . '/' . ltrim($path, '/');
    }
}

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

    public static function getSettings(): array
    {
        static $settings = null;

        if ($settings === null) {
            try {
                $rows = Database::fetchAll("SELECT `key`, `value` FROM settings");
                $settings = [];
                foreach ($rows as $row) {
                    $settings[$row['key']] = $row['value'];
                }
            } catch (\Exception $e) {
                $settings = [];
            }
        }

        return $settings;
    }

    /**
     * Get single setting value from database
     * @param string $key Setting key
     * @param string $default Default value if not found
     * @return string Setting value
     */
    public static function setting(string $key, string $default = ''): string
    {
        $settings = self::getSettings();
        return $settings[$key] ?? $default;
    }

    /**
     * Get page content from database
     * @param string $page Page identifier (home, about, contact, etc.)
     * @param string $section Section identifier (hero, services, cta, etc.)
     * @param string $field Field identifier (title, description, badge, etc.)
     * @param string $default Default value if not found
     * @return string Content value
     */
    public static function content(string $page, string $section, string $field, string $default = ''): string
    {
        static $contentCache = null;

        // Load all content on first call
        if ($contentCache === null) {
            try {
                $rows = Database::fetchAll("SELECT page, section, field, content FROM page_content");
                $contentCache = [];
                foreach ($rows as $row) {
                    $key = $row['page'] . '.' . $row['section'] . '.' . $row['field'];
                    $contentCache[$key] = $row['content'];
                }
            } catch (\Exception $e) {
                $contentCache = [];
            }
        }

        $key = $page . '.' . $section . '.' . $field;
        return $contentCache[$key] ?? $default;
    }

    /**
     * Shorthand for getting content with HTML escaping
     */
    public static function c(string $page, string $section, string $field, string $default = ''): string
    {
        return htmlspecialchars(self::content($page, $section, $field, $default), ENT_QUOTES, 'UTF-8');
    }
}

<?php
/**
 * SocialHero CMS
 * Main Entry Point
 */

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Autoloader
spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $prefix = 'App\\';
    $baseDir = BASE_PATH . '/app/';

    // Check if class uses the namespace prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get relative class name
    $relativeClass = substr($class, $len);

    // Convert namespace separators to directory separators
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // If file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

// Load environment variables
$envFile = BASE_PATH . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Initialize application
use App\Core\App;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\ContactController;

$app = new App();
$router = $app->getRouter();

// Define routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/sluzby', [PageController::class, 'services']);
$router->get('/sluzby/{slug}', [PageController::class, 'serviceDetail']);
$router->get('/reference', [PageController::class, 'references']);
$router->get('/cenik', [PageController::class, 'pricing']);
$router->get('/o-nas', [PageController::class, 'about']);
$router->get('/kontakt', [PageController::class, 'contact']);
$router->get('/blog', [PageController::class, 'blog']);

// API routes
$router->post('/api/contact', [ContactController::class, 'submit']);
$router->post('/api/newsletter', [ContactController::class, 'newsletter']);

// Run application
$app->run();

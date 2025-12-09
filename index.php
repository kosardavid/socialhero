<?php
/**
 * SocialHero CMS
 * Main Entry Point
 */

error_reporting(0);
ini_set('display_errors', '0');

define('BASE_PATH', __DIR__);

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = BASE_PATH . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) require $file;
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

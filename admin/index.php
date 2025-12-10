<?php
/**
 * SocialHero Admin Panel
 * Entry Point
 */

session_start();

// Define paths
define('BASE_PATH', dirname(__DIR__));
define('ADMIN_PATH', __DIR__);

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = BASE_PATH . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Load environment
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

// Load admin controllers
require_once ADMIN_PATH . '/Controllers/AuthController.php';
require_once ADMIN_PATH . '/Controllers/DashboardController.php';
require_once ADMIN_PATH . '/Controllers/ContentController.php';

use Admin\Controllers\AuthController;
use Admin\Controllers\DashboardController;
use Admin\Controllers\ContentController;

// Simple routing
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/admin';
$route = str_replace($basePath, '', $uri);
$route = rtrim($route, '/') ?: '/';

// Check if logged in (except for login route)
$publicRoutes = ['/', '/login'];
$isLoggedIn = isset($_SESSION['admin_user']);

if (!$isLoggedIn && !in_array($route, $publicRoutes)) {
    header('Location: ' . $basePath . '/login');
    exit;
}

// Route handling
$controller = new ContentController();

switch ($route) {
    // Auth routes
    case '/':
    case '/login':
        if ($isLoggedIn) {
            header('Location: ' . $basePath . '/dashboard');
            exit;
        }
        $authController = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;

    case '/logout':
        $authController = new AuthController();
        $authController->logout();
        break;

    case '/dashboard':
        $dashController = new DashboardController();
        $dashController->index();
        break;

    // Contacts
    case '/contacts':
        $controller->contacts();
        break;

    // Services CRUD
    case '/services':
        $controller->services();
        break;
    case '/services/create':
        $controller->serviceForm();
        break;

    // Pricing CRUD
    case '/pricing':
        $controller->pricing();
        break;
    case '/pricing/create':
        $controller->pricingForm();
        break;

    // FAQs CRUD
    case '/faqs':
        $controller->faqs();
        break;
    case '/faqs/create':
        $controller->faqForm();
        break;

    // Testimonials CRUD
    case '/testimonials':
        $controller->testimonials();
        break;
    case '/testimonials/create':
        $controller->testimonialForm();
        break;

    // Case Studies CRUD
    case '/case-studies':
        $controller->caseStudies();
        break;
    case '/case-studies/create':
        $controller->caseStudyForm();
        break;

    // Team CRUD
    case '/team':
        $controller->team();
        break;
    case '/team/create':
        $controller->teamForm();
        break;

    // Blog CRUD
    case '/blog':
        $controller->blog();
        break;
    case '/blog/create':
        $controller->blogForm();
        break;

    // Clients CRUD
    case '/clients':
        $controller->clients();
        break;
    case '/clients/create':
        $controller->clientForm();
        break;

    // Settings
    case '/settings':
        $controller->settings();
        break;
    case '/settings/password':
        $controller->changePassword();
        break;

    // Process Steps CRUD
    case '/process-steps':
        $controller->processSteps();
        break;
    case '/process-steps/create':
        $controller->processStepForm();
        break;

    // Certifications CRUD
    case '/certifications':
        $controller->certifications();
        break;
    case '/certifications/create':
        $controller->certificationForm();
        break;

    // Page SEO
    case '/page-seo':
        $controller->pageSeo();
        break;

    // Page Content
    case '/page-content':
        $controller->pageContent();
        break;

    default:
        // Dynamic routes with regex
        $matched = false;

        // Contacts detail
        if (preg_match('#^/contacts/(\d+)$#', $route, $matches)) {
            $controller->contactDetail($matches[1]);
            $matched = true;
        }
        // Contacts mark read
        elseif (preg_match('#^/contacts/(\d+)/mark-read$#', $route, $matches)) {
            $controller->markContactRead($matches[1]);
            $matched = true;
        }
        // Services edit/delete
        elseif (preg_match('#^/services/(\d+)/edit$#', $route, $matches)) {
            $controller->serviceForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/services/(\d+)/delete$#', $route, $matches)) {
            $controller->serviceDelete($matches[1]);
            $matched = true;
        }
        // Pricing edit/delete
        elseif (preg_match('#^/pricing/(\d+)/edit$#', $route, $matches)) {
            $controller->pricingForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/pricing/(\d+)/delete$#', $route, $matches)) {
            $controller->pricingDelete($matches[1]);
            $matched = true;
        }
        // FAQs edit/delete
        elseif (preg_match('#^/faqs/(\d+)/edit$#', $route, $matches)) {
            $controller->faqForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/faqs/(\d+)/delete$#', $route, $matches)) {
            $controller->faqDelete($matches[1]);
            $matched = true;
        }
        // Testimonials edit/delete
        elseif (preg_match('#^/testimonials/(\d+)/edit$#', $route, $matches)) {
            $controller->testimonialForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/testimonials/(\d+)/delete$#', $route, $matches)) {
            $controller->testimonialDelete($matches[1]);
            $matched = true;
        }
        // Case Studies edit/delete
        elseif (preg_match('#^/case-studies/(\d+)/edit$#', $route, $matches)) {
            $controller->caseStudyForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/case-studies/(\d+)/delete$#', $route, $matches)) {
            $controller->caseStudyDelete($matches[1]);
            $matched = true;
        }
        // Team edit/delete
        elseif (preg_match('#^/team/(\d+)/edit$#', $route, $matches)) {
            $controller->teamForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/team/(\d+)/delete$#', $route, $matches)) {
            $controller->teamDelete($matches[1]);
            $matched = true;
        }
        // Blog edit/delete
        elseif (preg_match('#^/blog/(\d+)/edit$#', $route, $matches)) {
            $controller->blogForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/blog/(\d+)/delete$#', $route, $matches)) {
            $controller->blogDelete($matches[1]);
            $matched = true;
        }
        // Clients edit/delete
        elseif (preg_match('#^/clients/(\d+)/edit$#', $route, $matches)) {
            $controller->clientForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/clients/(\d+)/delete$#', $route, $matches)) {
            $controller->clientDelete($matches[1]);
            $matched = true;
        }
        // Process Steps edit/delete
        elseif (preg_match('#^/process-steps/(\d+)/edit$#', $route, $matches)) {
            $controller->processStepForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/process-steps/(\d+)/delete$#', $route, $matches)) {
            $controller->processStepDelete($matches[1]);
            $matched = true;
        }
        // Certifications edit/delete
        elseif (preg_match('#^/certifications/(\d+)/edit$#', $route, $matches)) {
            $controller->certificationForm($matches[1]);
            $matched = true;
        }
        elseif (preg_match('#^/certifications/(\d+)/delete$#', $route, $matches)) {
            $controller->certificationDelete($matches[1]);
            $matched = true;
        }

        if (!$matched) {
            http_response_code(404);
            echo '404 - Page not found';
        }
        break;
}

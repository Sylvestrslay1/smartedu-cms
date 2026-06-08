<?php

declare(strict_types=1);

session_start();

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $path = dirname(__DIR__) . '/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

$config = require dirname(__DIR__) . '/config/config.php';
App\Core\App::boot($config);

$route = $_GET['r'] ?? 'site/index';
[$controllerId, $actionId] = array_pad(explode('/', trim($route, '/'), 2), 2, 'index');

$controllerClass = 'App\\Controllers\\' . ucfirst($controllerId) . 'Controller';
$actionMethod = 'action' . str_replace(' ', '', ucwords(str_replace('-', ' ', $actionId)));

if (!class_exists($controllerClass) || !method_exists($controllerClass, $actionMethod)) {
    http_response_code(404);
    $controllerClass = App\Controllers\SiteController::class;
    $actionMethod = 'actionNotFound';
}

$controller = new $controllerClass();
echo $controller->{$actionMethod}();

<?php

use Routing\Router;
use View\View;
use Exceptions\{NotFoundException, NotAuthorizedException};

//настройки для разработки
ini_set('display_errors', 1);
ini_set('log_errors', 1);

set_exception_handler(function ($e) {
    error_log($e->getMessage(), 0);
    (new View)->renderError(500);
});

spl_autoload_register(function (string $className) {
    require_once  __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
});

try {
    $route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    (new Router)->run($route);
} catch (NotFoundException $e) {
    (new View)->renderError(404);
} catch (NotAuthorizedException $e) {
    (new View)->renderError(403);
}
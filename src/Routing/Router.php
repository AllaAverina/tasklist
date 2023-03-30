<?php

namespace Routing;

use Exceptions\NotFoundException;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../../config/routes.php';
    }

    public function run(string $route): void
    {
        $way = $this->getWay($route);

        if (!$way) {
            throw new NotFoundException("Путь $route не определен");
        }
        
        $controllerName = $way['controller'];
        $actionName = $way['action'];
        $params = $way['params'];
        
        $controller = new $controllerName();
        $controller->$actionName(...$params);
    }

    public function getWay(string $route): ?array
    {
        foreach ($this->routes as $pattern => ['controller' => $controller, 'action' => $action]) {
            if (preg_match($pattern, $route, $matches)) {
                array_shift($matches);
                return ['controller' => $controller, 'action' => $action, 'params' => $matches];
            }
        }
        return null;
    }
}
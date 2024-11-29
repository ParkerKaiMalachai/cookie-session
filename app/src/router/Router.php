<?php

declare(strict_types=1);

namespace src\router;

use src\interfaces\RouterInterface;
use src\classes\exceptions\NotFoundRouterException;
use src\interfaces\ResponseInterface;

final class Router implements RouterInterface
{
    private array $routes = [];

    private array $actions = [];

    private string $uri;

    private ResponseInterface $response;

    public function __construct(array $routes, array $actions, string $uri, ResponseInterface $response)
    {
        $this->response = $response;

        $this->routes = $routes;

        $this->actions = $actions;

        $this->uri = $uri;
    }

    public function routePath(): void
    {
        if (isset($_POST['action'])) {
            $this->routeActions();
            return;
        }

        if (!isset($this->routes[$this->uri])) {
            $this->errorHandler('Not found');
        }

        $controlData = $this->routes[$this->uri];

        $controllerName = $controlData['controller'];

        $className = 'src\\controllers\\' . $controllerName . 'Controller';
        $instanceOfController = new $className($controllerName, $this->response);

        $actionName = $controlData['action'];

        $instanceOfController->$actionName();


    }

    public function routeActions(): void
    {
        if (!isset($this->actions[$_POST['action']])) {
            $this->errorHandler('Not found');
        }

        $actionData = $this->actions[$_POST['action']];

        $controller = $actionData['controller'];

        $action = $actionData['action'];

        $controllerName = 'src\\controllers\\' . $controller . 'Controller';

        $controllerInstance = new $controllerName($this->response);

        $controllerInstance->$action();

    }

    private function errorHandler($message): never
    {
        http_response_code(404);

        throw new NotFoundRouterException($message);
    }
}
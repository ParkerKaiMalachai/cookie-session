<?php

declare(strict_types=1);

namespace src\router;

use src\interfaces\RouterInterface;
use src\classes\exceptions\NotFoundRouterException;
use src\interfaces\ResponseInterface;

final class Router implements RouterInterface
{
    public array $routes = [];

    public array $actions = [];

    public string $uri;

    public ResponseInterface $response;

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

        if ($_POST['action'] === 'startSession' | $_POST['action'] === 'destroySession') {

            $controllerInstance = new $controllerName($controller, $this->response);
            $controllerInstance->$action();
            return;

        }

        $controllerInstance = new $controllerName();

        $controllerInstance->$action();

    }

    private function errorHandler($message): never
    {
        http_response_code(404);

        throw new NotFoundRouterException($message);
    }
}
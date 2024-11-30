<?php

declare(strict_types=1);

namespace src\router;

use src\interfaces\RouterInterface;
use src\classes\exceptions\NotFoundRouterException;
use src\interfaces\ResponseInterface;
use src\interfaces\RequestInterface;

final class Router implements RouterInterface
{
    private array $routes = [];

    private array $actions = [];

    private string $uri;

    private ResponseInterface $response;

    private RequestInterface $request;

    public function __construct(array $routes, array $actions, string $uri, ResponseInterface $response, RequestInterface $request)
    {
        $this->response = $response;

        $this->request = $request;

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

            $this->errorHandler("Route $this->uri not found");

        }

        $controlData = $this->routes[$this->uri];

        $controllerParams = $this->getControllerParams($controlData);

        $controllerName = $controlData['controller'];

        $actionName = $controllerParams['action'];

        $instanceOfController = new $controllerParams['name']($controllerName, $this->response);

        $instanceOfController->$actionName();


    }

    public function routeActions(): void
    {
        if (!isset($this->actions[$_POST['action']])) {

            $this->errorHandler("Action not found");

        }

        $actionData = $this->actions[$_POST['action']];

        $controllerParams = $this->getControllerParams($actionData);

        $action = $controllerParams['action'];

        $controllerInstance = new $controllerParams['name']($this->response, $this->request);

        $controllerInstance->$action();

    }

    private function errorHandler(string $message): never
    {
        http_response_code(404);

        throw new NotFoundRouterException($message);
    }

    private function getControllerParams(array $data): array
    {
        $controller = $data['controller'];

        $controllerName = 'src\\controllers\\' . $controller . 'Controller';

        $action = $data['action'];

        return ['name' => $controllerName, 'action' => $action];
    }
}
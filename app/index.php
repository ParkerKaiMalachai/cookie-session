<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use src\classes\exceptions\CookieEmptyParamsException;
use src\classes\exceptions\FileNotFoundException;
use src\classes\exceptions\NotFoundRouterException;
use src\router\Router;
use src\classes\Response;
use src\classes\Request;

$response = new Response();

$request = new Request();

$routesArray = [
    '/' => ['controller' => 'Home', 'action' => 'index']
];

$actionsArray = [
    'setCookie' => ['controller' => 'Cookie', 'action' => 'setCookie'],
    'removeCookie' => ['controller' => 'Cookie', 'action' => 'removeCookie'],
    'startSession' => ['controller' => 'Session', 'action' => 'startSession'],
    'destroySession' => ['controller' => 'Session', 'action' => 'destroySession']
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router($routesArray, $actionsArray, $uri, $response, $request);

try {
    $router->routePath();
} catch (NotFoundRouterException $e) {
    echo $e->getMessage();
} catch (FileNotFoundException $e) {
    echo $e->getMessage();
} catch (CookieEmptyParamsException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}
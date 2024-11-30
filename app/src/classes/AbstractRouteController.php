<?php

declare(strict_types=1);

namespace src\classes;

use src\interfaces\RoutesControllerInterface;
use src\interfaces\ResponseInterface;

abstract class AbstractRouteController implements RoutesControllerInterface
{
    public string $view;

    public string $path;

    public ResponseInterface $response;

    public function __construct(string $path, ResponseInterface $response)
    {
        $this->response = $response;

        $toLowePath = strtolower($path);

        $this->path = $toLowePath;

        $this->view = $this->path;
    }

    abstract public function index();

}
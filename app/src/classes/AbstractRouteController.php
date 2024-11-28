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

        $this->view = 'src/views/' . $this->path . '.php';
    }

    abstract public function index();

    protected function validViewFile(): bool
    {
        if (!file_exists($this->view)) {
            return false;
        }

        return true;
    }
}
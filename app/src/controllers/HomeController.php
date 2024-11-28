<?php

declare(strict_types=1);

namespace src\controllers;

use src\classes\exceptions\FileNotFoundException;
use src\classes\AbstractRouteController;

final class HomeController extends AbstractRouteController
{

    public function index(): void
    {
        if (!$this->validViewFile()) {

            throw new FileNotFoundException('File not found');

        }

        $this->response->send($this->view);
    }

}
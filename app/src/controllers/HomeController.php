<?php

declare(strict_types=1);

namespace src\controllers;

use src\classes\AbstractRouteController;

final class HomeController extends AbstractRouteController
{

    public function index(): void
    {

        $this->response->send($this->view);

    }

}
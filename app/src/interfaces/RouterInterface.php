<?php

declare(strict_types=1);

namespace src\interfaces;

interface RouterInterface
{
    public function routePath();

    public function routeActions();
}
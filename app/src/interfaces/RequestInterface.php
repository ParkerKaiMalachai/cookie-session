<?php

declare(strict_types=1);

namespace src\interfaces;

interface RequestInterface
{
    public function getPostParam(array $names);
}
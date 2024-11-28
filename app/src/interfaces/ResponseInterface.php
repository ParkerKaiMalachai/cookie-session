<?php

declare(strict_types=1);

namespace src\interfaces;

interface ResponseInterface
{
    public function send(string $file);

    public function sendWithSession(string $file, array $params);
}
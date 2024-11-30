<?php

declare(strict_types=1);

namespace src\interfaces;

interface ResponseInterface
{
    public function send(string $file);

    public function sendWithSession(array $params);

    public function sendCookie(string $name, string $value, int $expire, string $path);

    public function removeCookie(string $name, string $value, int $expire, string $path);
}
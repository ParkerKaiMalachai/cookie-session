<?php

declare(strict_types=1);

namespace src\classes;

use src\interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    public function send(string $file): void
    {
        require $file;
    }

    public function sendWithSession(string $file, array $params): void
    {
        session_start();

        $_SESSION['name'] = $params['name'];

        $sessions = $_SESSION;

        require $file;
    }
}
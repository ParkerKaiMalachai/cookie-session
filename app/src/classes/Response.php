<?php

declare(strict_types=1);

namespace src\classes;

use src\classes\exceptions\FileNotFoundException;
use src\interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    public function send(string $file): void
    {
        $file = 'src/views/' . $file . '.php';

        if (!$this->validViewFile($file)) {

            throw new FileNotFoundException('File not found');

        }

        require $file;
    }

    public function sendWithSession(array $params): void
    {
        session_start([
            'cookie_lifetime' => 0,
        ]);

        $_SESSION['name'] = $params['param'];

        echo json_encode($_SESSION);

    }

    public function destroySession(): void
    {
        if (isset($_COOKIE['PHPSESSID'])) {

            setcookie('PHPSESSID', '', time() - 3600, '/');

        }

        session_destroy();
    }

    public function sendCookie(string $name, string $value, int $expire, string $path): bool
    {
        return setcookie($name, $value, $expire, $path);
    }

    public function removeCookie(string $name, string $value, int $expire, string $path): bool
    {
        return setcookie($name, $value, $expire, $path);
    }

    protected function validViewFile(string $file): bool
    {
        if (!file_exists($file)) {

            return false;

        }

        return true;
    }
}
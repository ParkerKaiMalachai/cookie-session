<?php

declare(strict_types=1);

namespace src\classes;

use src\classes\exceptions\SessionEmptyParamException;
use src\interfaces\SessionManagerInterface;

final class SessionManager implements SessionManagerInterface
{
    private array $sessionValues = [];

    public function get(): array
    {
        return $this->sessionValues;
    }

    public function set(string $value): void
    {
        session_start();

        if (empty($value)) {

            throw new SessionEmptyParamException('empty param');
        }

        $_SESSION['name'] = $value;

        $this->sessionValues['name'] = $value;
    }

    public function remove(): void 
    {
        session_start();

        unset($_SESSION['name']);

        if (isset($_COOKIE['PHPSESSID'])) {

            setcookie('PHPSESSID', '', time() - 3600, '/');

        }

        session_destroy();
        
        unset($this->sessionValues['name']);
    }
}

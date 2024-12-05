<?php

declare(strict_types=1);

namespace src\classes;

use src\classes\exceptions\CookieEmptyParamsException;
use src\interfaces\CookieManagerInterface;

final class CookieManager implements CookieManagerInterface
{
    private array $cookies = [];

    public function get(): array
    {
        return $this->cookies;
    }

    public function set(string $name, string $value, int $expire, string $path): void
    {
        if (empty($name) | empty($value) | empty($expire) | empty($path)) {

            throw new CookieEmptyParamsException('Empty params');
        }

        setCookie($name, $value, time() + $expire, $path);

        $this->cookies[$name] = $value;
    }

    public function remove(string $name): void
    {
        if (empty($name)) {

            throw new CookieEmptyParamsException('Empty param');
        }

        setCookie($name, '', time() - 3600, '/');

        unset($this->cookies[$name]);
    }
}
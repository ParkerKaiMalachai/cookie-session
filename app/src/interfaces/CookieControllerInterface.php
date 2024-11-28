<?php

declare(strict_types=1);

namespace src\interfaces;

interface CookieControllerInterface
{
    public function setCookie();

    public function removeCookie();
}
<?php

declare(strict_types=1);

require 'app/autoload.php';
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\controllers\CookieController;

final class CookieControllerTest extends TestCase
{
    public function testSetCookie(): void
    {
        $_POST['name'] = 'bbb';
        $_POST['value'] = 'ddd';
        $_POST['expire'] = 5;

        $cookieController = new CookieController();

        $this->assertTrue($cookieController->setCookie());
    }

    public function testRemoveCookie(): void
    {
        $cookieController = new CookieController();

        $this->assertTrue($cookieController->removeCookie());
    }

}
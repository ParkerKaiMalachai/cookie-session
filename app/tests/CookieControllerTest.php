<?php

declare(strict_types=1);

require 'app/autoload.php';
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\classes\CookieManager;

final class CookieControllerTest extends TestCase
{
    public function testSetCookie(): void
    {
        $cookieManager = new CookieManager();

        $cookieManager->set('beep', 'val', 777, '/');

        $this->assertArrayHasKey('beep', $cookieManager->get());
    }

    public function testRemoveCookie(): void
    {
        $cookieManager = new CookieManager();

        $cookieManager->set('beep', 'val', 777, '/');

        $cookieManager->remove('beep');

        $this->assertArrayHasKey('beep', $cookieManager->get());
    }

}
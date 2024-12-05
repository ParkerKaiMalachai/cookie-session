<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\classes\SessionManager;

final class SessionControllerTest extends TestCase
{

    public function testStartSession(): void
    {
        $sessionManager = new SessionManager();

        $sessionManager->set('poop');

        $this->assertArrayHasKey('name', $sessionManager->get());
    }

    public function testDestroySession(): void
    {
        $sessionManager = new SessionManager();

        $sessionManager->set('poop');

        $sessionManager->remove();

        $this->assertArrayHasKey('name', $sessionManager->get());
    }
}

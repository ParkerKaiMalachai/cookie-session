<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\controllers\SessionController;
use src\classes\Response;

final class SessionControllerTest extends TestCase
{
    public function getInitParam(): Response
    {
        $mock = Mockery::mock(Response::class);
        return $mock;
    }

    public function testStartSession(): void
    {
        $mock = $this->getInitParam();

        $mock->shouldReceive('sendWithSession')->andReturn('');

        $sessionController = new SessionController('Session', $mock);

        $sessionController->view = 'app/src/views/session.php';

        $_SESSION['name'] = $_POST['name'];

        $sessionController->index();

        $this->assertArrayHasKey('name', $sessionController->sessions);
    }

    public function testDestroySession(): void
    {
        $mock = $this->getInitParam();

        $mock->shouldReceive('sendWithSession')->andReturn('');

        $sessionController = new SessionController('Session', $mock);

        $sessionController->view = 'app/src/views/session.php';

        $sessionController->index();

        $this->assertArrayHasKey('name', $sessionController->destroySession());
    }
}
;
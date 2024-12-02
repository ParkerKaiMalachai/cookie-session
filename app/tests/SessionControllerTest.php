<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\classes\Request;
use src\controllers\SessionController;
use src\classes\Response;

final class SessionControllerTest extends TestCase
{
    public function getInitMocks(): array
    {
        $mockResponse = Mockery::mock(Response::class);

        $mockRequest = Mockery::mock(Request::class);

        return ['request' => $mockRequest, 'response' => $mockResponse];
    }

    public function testStartSession(): void
    {
        $mocks = $this->getInitMocks();

        $mockResponse = $mocks['response'];

        $mockRequest = $mocks['request'];

        $mockRequest->shouldReceive('getPostParam')->andReturn(['name' => $_POST['name']]);

        $mockResponse->shouldReceive('sendWithSession')->andReturn('');

        $sessionController = new SessionController($mockResponse, $mockRequest);

        $_SESSION['name'] = $_POST['name'];

        $sessionController->startSession();

        $this->assertArrayHasKey('name', $sessionController->sessions);
    }

    public function testDestroySession(): void
    {

        $mocks = $this->getInitMocks();

        $mockResponse = $mocks['response'];

        $mockRequest = $mocks['request'];

        $_POST['action'] = 'destroySession';

        $mockRequest->shouldReceive('getPostParam')->andReturn(['name' => $_POST['name']]);

        $mockResponse->shouldReceive('destroySession')->andReturn('');

        $sessionController = new SessionController($mockResponse, $mockRequest);

        $sessionController->destroySession();

        $this->assertArrayHasKey('name', $sessionController->sessions);
    }
}

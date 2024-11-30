<?php

declare(strict_types=1);

require 'app/autoload.php';
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\classes\Request;
use src\classes\Response;
use src\controllers\CookieController;

final class CookieControllerTest extends TestCase
{
    public function getInitMocks(): array
    {
        $mockResponse = Mockery::mock(Response::class);

        $mockRequest = Mockery::mock(Request::class);

        return ['request' => $mockRequest, 'response' => $mockResponse];
    }
    public function testSetCookie(): void
    {
        $mocks = $this->getInitMocks();

        $mockResponse = $mocks['response'];

        $mockRequest = $mocks['request'];

        $_POST['name'] = 'bbb';

        $_POST['value'] = 'ddd';

        $_POST['expire'] = 5;

        $arrayOfParams = ['name' => $_POST['name'], 'value' => $_POST['value'], 'expire' => $_POST['expire']];


        $mockRequest->shouldReceive('getPostParam')->andReturn($arrayOfParams);

        $mockResponse->shouldReceive('sendCookie')->andReturn(true);

        $cookieController = new CookieController($mockResponse, $mockRequest);

        $this->assertTrue($cookieController->setCookie());
    }

    public function testRemoveCookie(): void
    {
        $mocks = $this->getInitMocks();

        $mockResponse = $mocks['response'];

        $mockRequest = $mocks['request'];

        $mockRequest->shouldReceive('getPostParam')->andReturn(['name' => $_POST['name']]);

        $mockResponse->shouldReceive('removeCookie')->andReturn(true);

        $cookieController = new CookieController($mockResponse, $mockRequest);

        $this->assertTrue($cookieController->removeCookie());
    }

}
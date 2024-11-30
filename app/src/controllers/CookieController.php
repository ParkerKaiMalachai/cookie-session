<?php

declare(strict_types=1);

namespace src\controllers;

use src\classes\exceptions\CookieEmptyParamsException;
use src\interfaces\CookieControllerInterface;
use src\interfaces\RequestInterface;
use src\interfaces\ResponseInterface;

final class CookieController implements CookieControllerInterface
{
    private RequestInterface $request;

    private ResponseInterface $response;

    public function __construct(ResponseInterface $response, RequestInterface $request)
    {
        $this->request = $request;

        $this->response = $response;
    }

    public function setCookie(): bool
    {
        $values = $this->getParamsForSetting();

        if (count($values) === 0) {

            throw new CookieEmptyParamsException('Empty set of params');

        }

        return $this->response->sendCookie($values['name'], $values['value'], time() + +$values['expire'], '/');
    }

    public function removeCookie(): bool
    {
        $value = $this->getParamForRemove();

        if (count($value) === 0) {

            throw new CookieEmptyParamsException('Empty param for removing');

        }

        return $this->response->removeCookie($value['name'], '', time() - 3600, '/');

    }

    private function getParamsForSetting(): array
    {

        $values = $this->request->getPostParam(['name', 'value', 'expire']);

        foreach ($values as $key => $value) {

            if (empty($value)) {

                return [];

            }

            $resultValues[$key] = $value;
        }

        return $resultValues;
    }

    private function getParamForRemove(): array
    {
        $name = $this->request->getPostParam(['name']);

        if (empty($name['name'])) {

            return [];

        }

        return ['name' => $name['name']];
    }
}

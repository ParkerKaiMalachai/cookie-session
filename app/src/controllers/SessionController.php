<?php

declare(strict_types=1);

namespace src\controllers;

use src\classes\exceptions\SessionEmptyParamException;
use src\interfaces\RequestInterface;
use src\interfaces\ResponseInterface;
use src\interfaces\SessionControllerInterface;

final class SessionController implements SessionControllerInterface
{
    public array $sessions;

    public ResponseInterface $response;

    public RequestInterface $request;

    public function __construct(ResponseInterface $response, RequestInterface $request)
    {
        $this->response = $response;

        $this->request = $request;
    }

    public function startSession(): array
    {

        $params = $this->getParams('name');

        if (count($params) === 0) {

            throw new SessionEmptyParamException('Empty set of params');

        }

        $this->response->sendWithSession($params);

        $this->sessions = $_SESSION;

        return $this->sessions;
    }

    public function destroySession(): array
    {

        $this->sessions = [];

        $this->response->destroySession();

        return $this->sessions;
    }

    private function getParams(string $name): array
    {
        $param = $this->request->getPostParam([$name]);

        if (empty($param)) {

            return [];

        }

        return ['param' => $param[$name]];
    }

}
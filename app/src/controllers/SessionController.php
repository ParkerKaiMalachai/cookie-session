<?php

declare(strict_types=1);

namespace src\controllers;

use src\classes\exceptions\SessionEmptyParamException;
use src\interfaces\ResponseInterface;
use src\interfaces\SessionControllerInterface;

final class SessionController implements SessionControllerInterface
{
    public array $sessions;

    public ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function startSession(): array
    {

        $params = $this->getParams();

        if (count($params) === 0 && $_POST['action'] !== 'destroySession') {
            throw new SessionEmptyParamException('Empty set of params');
        }

        $this->response->sendWithSession($params);

        $this->sessions = $_SESSION;

        if ($_POST['action'] === 'destroySession') {
            $this->destroySession();
        }

        return $this->sessions;
    }

    public function destroySession(): array
    {
        $this->sessions = [];

        session_destroy();

        return $this->sessions;
    }

    private function getParams(): array
    {
        if (!isset($_POST['name'])) {
            return [];
        }

        $name = $_POST['name'];

        return ['name' => $name];
    }
}
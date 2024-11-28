<?php

declare(strict_types=1);

namespace src\controllers;

use src\classes\exceptions\SessionEmptyParamException;
use src\classes\exceptions\FileNotFoundException;
use src\classes\AbstractRouteController;

final class SessionController extends AbstractRouteController
{
    public array $sessions;

    public function index(): array
    {
        if (!$this->validViewFile()) {

            throw new FileNotFoundException('File not found');

        }

        $params = $this->getParams();

        if (count($params) === 0) {
            throw new SessionEmptyParamException('Empty set of params');
        }

        $this->response->sendWithSession($this->view, $params);

        $this->sessions = $_SESSION;

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
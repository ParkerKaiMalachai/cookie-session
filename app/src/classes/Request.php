<?php

declare(strict_types=1);

namespace src\classes;

use src\interfaces\RequestInterface;

class Request implements RequestInterface
{
    public function getPostParam(array $names): array
    {
        foreach ($names as $name) {

            if (!isset($_POST[$name]) | empty($_POST[$name])) {

                return [];

            }

            $postParams[$name] = $_POST[$name];
        }

        return $postParams;
    }
}
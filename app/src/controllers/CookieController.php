<?php

declare(strict_types=1);

namespace src\controllers;

use src\classes\exceptions\CookieEmptyParamsException;
use src\interfaces\CookieControllerInterface;

final class CookieController implements CookieControllerInterface
{
    public function setCookie(): bool
    {
        $values = $this->getParamsForSetting();

        if (count($values) === 0) {

            throw new CookieEmptyParamsException('Empty set of params');

        }

        return setcookie($values['name'], $values['value'], time() + +$values['expire'], '/');
    }

    public function removeCookie(): bool
    {
        $value = $this->getParamForRemove();

        if (count($value) === 0) {

            throw new CookieEmptyParamsException('Empty param for removing');

        }

        return setcookie($value['name'], '', time() - 3600, '/');
    }

    private function getParamsForSetting(): array
    {
        if (!isset($_POST['name']) && !isset($_POST['value']) && !isset($_POST['expire'])) {

            return [];

        }

        $name = $_POST['name'];

        $value = $_POST['value'];

        $expire = $_POST['expire'];

        return ['name' => $name, 'value' => $value, 'expire' => $expire];
    }

    private function getParamForRemove(): array
    {
        if (!isset($_POST['name'])) {

            return [];

        }

        $name = $_POST['name'];

        return ['name' => $name];
    }
}

<?php

declare(strict_types=1);

namespace src\interfaces;

interface SessionManagerInterface
{
    public function get();

    public function set(string $value);

    public function remove();
}
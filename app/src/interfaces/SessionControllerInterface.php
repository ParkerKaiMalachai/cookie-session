<?php

declare(strict_types=1);

namespace src\interfaces;

interface SessionControllerInterface
{
    public function startSession();

    public function destroySession();
}
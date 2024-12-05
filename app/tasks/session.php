<?php

declare(strict_types=1);

require '../vendor/autoload.php';

use src\classes\SessionManager;
use src\classes\exceptions\SessionEmptyParamException;

$sessionManager = new SessionManager();

try {
    switch ($_POST['action']) {
        case 'startSession':
            $sessionManager->set($_POST['name']);
            break;
        case 'destroySession':
            $sessionManager->remove();
            break;
        default:
            echo 'no action';
    }
} catch (SessionEmptyParamException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}
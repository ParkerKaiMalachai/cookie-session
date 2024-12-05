<?php

declare(strict_types=1);

require '../vendor/autoload.php';

use src\classes\CookieManager;
use src\classes\exceptions\CookieEmptyParamsException;

$cookieManager = new CookieManager();

try {
    switch ($_POST['action']) {
        case 'setCookie':
            $cookieManager->set($_POST['name'], $_POST['value'], intval($_POST['expire']), '/');
            break;
        case 'removeCookie':
            $cookieManager->remove($_POST['name']);
            break;
        default:
            echo 'no action';
    }
} catch (CookieEmptyParamsException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

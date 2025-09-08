<?php

use App\Controller\UserController;

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI']

if ($uri == '/user') {
    new UserController;
}

?>



<?php

namespace App\Controller;

use App\Model\User;
use App\Core\Database;

class UserController
{
    public function login()
    {
        $content_view = __DIR__ . '/../View/login.phtml';

        require_once __DIR__ . '/../View/layout.phtml';
    }
}

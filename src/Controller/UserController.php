<?php

namespace App\Controller;

use App\Model\User;

class UserController
{

    public function __construct()
    {
        if ($_POST) {
            $user = new User(
                name: $_POST['user_name'],
                password: $_POST['user_password']
            );

            $user->save();

            echo $user->validatePassword('123') ? 'Senha é 123' : 'Senha não é 123';
        }
        $users = User::findAll();

        include __DIR__.'/../View/users.phtml';
    }
}

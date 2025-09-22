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

    public function autenticar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $em = Database::getEntityManager();

            $name = $_POST['name'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $em->getRepository(User::class)->findOneBy(['name' => $name]);

            if ($user && $user->validatePassword($password)) {
                $_SESSION['user_id'] = $user->getId();
                header("Location: /index.php?controller=venda&action=index");
                exit();
            } else {
                header("Location: /index.php?controller=user&action=login&erro=1");
                exit();
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);

        session_destroy();

        header("Location: /index.php?controller=user&action=login");
        exit();
    }
}

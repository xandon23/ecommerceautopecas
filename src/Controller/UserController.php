<?php

namespace App\Controller;

use App\Model\User;
use App\Core\Database;

class UserController
{
    // Método para exibir o formulário de login (GET)
    public function login()
    {
        require_once __DIR__ . '/../View/login.phtml';
    }

    // Método para processar a autenticação (POST)
    public function autenticar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $em = Database::getEntityManager();
            
            $name = $_POST['name'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $em->getRepository(User::class)->findOneBy(['name' => $name]);

            if ($user && password_verify($password, $user->getPassword())) {
                // Autenticação bem-sucedida, redireciona
                header("Location: /index.php?controller=venda&action=listar");
                exit();
            } else {
                // Autenticação falhou, redireciona com erro
                header("Location: /index.php?controller=user&action=login&erro=1");
                exit();
            }
        }
    }
}
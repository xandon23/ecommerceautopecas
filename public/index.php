<?php

// Ativa a exibição de erros para ajudar na depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui o autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Define a ação padrão e o controlador padrão
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'ProdutoController';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Cria o caminho completo para o controlador
$controllerClass = "App\\Controller\\" . $controllerName;

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();

    if (method_exists($controller, $actionName)) {
        // Executa a ação do controlador
        $controller->$actionName();
    } else {
        // Se a ação não existir
        echo "Ação não encontrada!";
    }
} else {
    // Se o controlador não existir
    echo "Controlador não encontrado!";
}
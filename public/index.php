<?php

// Ativa a exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui o Autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Define o controlador e a ação padrão
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'login';

// Formata o nome da classe do controlador
$controllerClass = "App\\Controller\\" . ucfirst($controllerName) . 'Controller';

// Verifica se a classe do controlador existe e cria uma instância
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
} else {
    echo "Controlador não encontrado!";
    exit;
}

// Verifica se a ação existe no controlador
if (method_exists($controller, $actionName)) {
    // Executa a ação
    $controller->$actionName();
} else {
    echo "Ação não encontrada!";
    exit;
}
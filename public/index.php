<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

// Define o controlador e a ação padrão
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'venda';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Formata o nome da classe do controlador
$controllerClass = "App\\Controller\\" . ucfirst($controllerName) . 'Controller';

// Verifica se a classe do controlador existe
if (!class_exists($controllerClass)) {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>O controlador " . htmlspecialchars($controllerName) . " não foi encontrado.</p>";
    exit;
}

// Cria uma instância do controlador
$controller = new $controllerClass();

// Verifica se o método de ação existe
if (!method_exists($controller, $actionName)) {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>A ação " . htmlspecialchars($actionName) . " não foi encontrada no controlador " . htmlspecialchars($controllerName) . ".</p>";
    exit;
}

// Executa a ação
$controller->$actionName();
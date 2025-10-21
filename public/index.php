<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';


$controllerClass = "App\\Controller\\" . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
} else {
    echo "Controlador não encontrado!";
    exit;
}

if (method_exists($controller, $actionName)) {
    $controller->$actionName();
} else {
    echo "Ação não encontrada!";
    exit;
}
?>

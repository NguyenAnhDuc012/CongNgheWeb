<?php
// index.php
session_start();

$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

$controllerFile = 'controllers/' . ucfirst($controller) . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . 'Controller';
    $controllerObj = new $controllerClass();
    if ($action == 'edit' || $action == 'delete') {
        $id = $_GET['id'] ?? null;
        $controllerObj->$action($id);
    } else {
        $controllerObj->$action();
    }
} else {
    require_once 'controllers/ProductController.php';
    $controllerObj = new ProductController();
    $controllerObj->index();
}

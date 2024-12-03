<?php
// index.php
session_start();

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerFile = 'controllers/' . ucfirst($controller) . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . 'Controller';
    $controllerObj = new $controllerClass();
    if ($action == 'detail') {
        $id = $_GET['id'] ?? null;
        $controllerObj->$action($id);
    }
    else if ($action == 'deleteNews') {
        $id = $_GET['id'] ?? null;
        $controllerObj->$action($id);
    } else {
        $controllerObj->$action();
    }
} else {
    require_once 'controllers/HomeController.php';
    $controllerObj = new HomeController();
    $controllerObj->index();
}

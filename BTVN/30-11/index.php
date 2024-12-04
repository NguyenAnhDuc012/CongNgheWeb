<?php
// index.php

// session_start();

// $controller = $_GET['controller'] ?? 'product';
// $action = $_GET['action'] ?? 'index';

// $controllerFile = 'controllers/' . ucfirst($controller) . 'Controller.php';

// if (file_exists($controllerFile)) {
//     require_once $controllerFile;
//     $controllerClass = ucfirst($controller) . 'Controller';
//     $controllerObj = new $controllerClass();
//     if ($action == 'edit' || $action == 'delete') {
//         $id = $_GET['id'] ?? null;
//         $controllerObj->$action($id);
//     } else {
//         $controllerObj->$action();
//     }
// } else {
//     require_once 'controllers/ProductController.php';
//     $controllerObj = new ProductController();
//     $controllerObj->index();
// }


// Tự động tải các file cần thiết
spl_autoload_register(function ($class) {
    if (file_exists("controllers/$class.php")) {
        require_once "controllers/$class.php";
    } elseif (file_exists("models/$class.php")) {
        require_once "models/$class.php";
    }
});

// Lấy thông tin từ URL
$controllerName = $_GET['controller'] ?? 'Product';
$actionName = $_GET['action'] ?? 'index';

// Kiểm tra xem Controller có tồn tại không
$controllerClass = ucfirst($controllerName) . 'Controller';
if (!class_exists($controllerClass)) {
    die("Controller $controllerClass not found.");
}

// Tạo Controller
$controller = new $controllerClass();

// Kiểm tra xem Action có tồn tại không
if (!method_exists($controller, $actionName)) {
    die("Action $actionName not found in $controllerClass.");
}

// Gọi Action
if ($actionName == "edit" || $actionName == "delete") {
    $controller->$actionName($_GET['id']);
} else {
    $controller->$actionName();
}

<?php
use controllers\ProductsController;
use controllers\UsersController;
use controllers\OrderProductsController;
require_once 'autoload.php';


$action = '';
$action = $_GET['action'] ?? 'index' ;
if(!$action && $_SERVER['REQUEST_URI'] == '/') {
    $action = 'index';
}

if($action == 'index') {
    $controller= new ProductsController();
    die($controller->index());
}
if($action == 'users') {
    $controller= new UsersController();
    die($controller->index());
}
if($action == 'order-products') {
    $controller= new OrderProductsController();
    die($controller->index());
}
header("HTTP/1.0 404 Not Found");
exit;

<?php
use controllers\ProductsController;
use controllers\UsersController;
use controllers\OrdersController;
require_once 'autoload.php';


echo '*******<pre>';
print_r($_GET);
echo '*******';
$action = '';

$action = array_pop($_GET);
//$action='';
if(!$action && $_SERVER['REQUEST_URI'] == '/') {
    $action = 'index';
}
print_r($action);

if($action == 'index') {
    $controller= new ProductsController();
    die($controller->index());
}
if($action == 'users') {
    echo 'Heey';
    $controller= new UsersController();
    die($controller->index());
}

header("HTTP/1.0 404 Not Found");
exit;

?>
<!--<style>--><?php //include 'C:/xampp/htdocs/php3_1/style.css'; ?><!--</style>-->
<?php

require_once '../autoload.php';
session_start();


$user_data = $_POST;
$udb = Users::getInstanceCall();
$odb = Orders::getInstanceCall();
$opdb = OrderProducts::getInstanceCall();

/*insert user*/
$udb->insert($user_data);

/*insert order*/
$userData = $udb->getUserByEmail($user_data['email']);
$uId = $userData['id'];
$orders["sum"] = $_SESSION["totalSum"];
$orders["user_id"] = $uId;
$odb->insert($orders);

/*inset in order_products*/
$products = $_SESSION['product'];
$orderData = $odb->getById($uId);

foreach ($products as $product) {
    $orderProduct['product_id'] = $product['Id'];
    $orderProduct['order_id'] = $orderData['Id'];
    $orderProduct['qty'] = $product['count'];
    $orderProducts[] = $orderProduct;


}

foreach ($orderProducts as $op) {
    $opdb->insert($op);
}

echo '<form method="post" action="../orders/orders.php">';
echo '<input type="submit" value="show orders"/>';
echo '</form>'

?>
<style><?php include 'C:/xampp/htdocs/php3_1/style.css'; ?></style>
<?php
require_once '../autoload.php';

$user_data = $_POST;

$opdb = OrderProducts::getInstanceCall();

$list = $opdb->joinAll();

echo "<table>
    <tr>
    <th>ID</th>
    <th>ORDER_ID</th>
    <th>PRODUCT_ID</th>
    <th>QTY</th>
    <th>PRODUCT NAME</th>
    <th>DESCRIPTION</th>
    <th>PRICE</th>
    <th>USER_ID</th>
    <th>SUM</th>
    <th>ORDER_DATE</th>
    <th>FIRST_NAME</th>
    <th>LAST_NAME</th>
    <th>EMAIL</th></tr>";

$id = 0;
foreach ($list as $key => $val) {
    echo "<tr><td>$key</td>";
    foreach ($val as $k => $v) {
        $d = $k != 'id';
        if (!(($k === 'id') || ($k === 'Id'))) {
            echo "<td>$v</td>";
        }
    }
    echo '</tr>';
}

echo '</table>';

?>
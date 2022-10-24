<!--<!--<style>-->--><?php ////include 'C:/xampp/htdocs/php3_1/style.css'; ?><!--<!--</style>-->-->
<?php
//require_once '../autoload.php';
//session_start();
//
//$db = ProductsController::getInstanceCall();
//$sel = $db->select();
//$data = $_POST;
//$buyId = [];
//$countProduct = [];
//foreach ($data as $k => $val) {
//    if (str_contains($k, 'ckbox')) {
//        $buyId[] = substr($k, 5);
//    } else {
//        if ($val) {
//            $index = substr($k, 5);
//            $countProduct[$index] = $val;
//        }
//    }
//}
//
//$selData = [];
//foreach ($buyId as $id) {
//    $selData[] = $db->selectById($id);
//}
//
//foreach ($selData as $key => $dat) {
//    $ind = $dat['Id'];
//    $dat['count'] = $countProduct[$ind];
//    $selData[$key] = $dat;
//}
//
//echo "<table>
//    <tr>
//    <th>ID</th>
//    <th>NAME</th>
//    <th>DESCRIPTION</th>
//    <th>PRICE</th>
//    <th>COUNT</th>
//    </tr>";
//foreach ($selData as $val) {
//    echo "<tr>";
//    foreach ($val as $v) {
//        echo "<td>$v</td>";
//    }
//    echo "</tr>";
//}
//
//$totalSum = 0;
//foreach ($selData as $arr) {
//    $totalSum += $arr['price'] * $arr['count'];
//}
//
//$_SESSION["totalSum"] = $totalSum;
//$_SESSION['product'] = $selData;
//
//echo "<tr>
//<td style='text-align: right'  colspan='5'>$totalSum</td>
//</tr>";
//echo "</table>";
//
//echo "<form  method='post' action='add.php'>";
//echo "<input type='text' name='fname' placeholder='First name' required />";
//echo "<input type='text' name='lname' placeholder='Last name' required/>";
//echo "<input type='email' name='email' placeholder='Email' required/>";
//
//echo "<input type='submit' value='submit' />";
//
//echo "</form>";
//
//
//?>
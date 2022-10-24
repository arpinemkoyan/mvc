<?php
require_once './models/Products.php';
session_start();

$data = $_POST;
$buyId = [];
$countProduct = [];
foreach ($data as $k => $val) {
    if (str_contains($k, 'ckbox')) {
        $buyId[] = substr($k, 5);
    } else {
        if ($val) {
            $index = substr($k, 5);
            $countProduct[$index] = $val;
        }
    }
}

$selData = [];
foreach ($buyId as $id) {
    $selData[] = $db->selectById($id);
}

foreach ($selData as $key => $dat) {
    $ind = $dat['Id'];
    $dat['count'] = $countProduct[$ind];
    $selData[$key] = $dat;
}


$totalSum = 0;
foreach ($selData as $arr) {
    $totalSum += $arr['price'] * $arr['count'];
}

$_SESSION["totalSum"] = $totalSum;
$_SESSION['product'] = $selData;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders</title>
    <style></style>
<!--    <link rel="stylesheet" href="./style.css">-->
</head>
<body>
<div class="container">

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>PRICE</th>
            <th>COUNT</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($selData as $val): ?>
            <tr>
                <?php foreach ($val as $v): ?>
                    <td>$v</td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td style='text-align: right' colspan='5'>$totalSum</td>
        </tr>
        </tbody>
    </table>


    <form method='post' action='add.php'>
        <input type='text' name='fname' placeholder='First name' required/>";
        <input type='text' name='lname' placeholder='Last name' required/>";
        <input type='email' name='email' placeholder='Email' required/>";

        <input type='submit' value='submit'/>";

    </form>

</div>
</body>
</html>

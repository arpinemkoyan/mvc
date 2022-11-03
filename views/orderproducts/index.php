<?php
require_once './models/OrderProducts.php';
require_once './models/Users.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <style></style>
    <link rel="stylesheet" href='style.css'>
</head>
<body>
<div class="container">
    <table>
        <thead>
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
            <th>EMAIL</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $key => $val): ?>
            <tr>
                <td><?= $key ?></td>
                <?php foreach ($val as $k => $v): ?>
                    <?php if (!(($k === 'id') || ($k === 'Id'))): ?>
                        <td><?= $v ?></td>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html>


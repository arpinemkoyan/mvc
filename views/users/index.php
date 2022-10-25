<?php
require_once './models/Users.php';
session_start();
$_SESSION['totalSum']=$totalSum;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders</title>
    <style></style>
    <link rel="stylesheet" href="./style.css">
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
        <?php foreach ($orders as $val): ?>
            <tr>
                <?php foreach ($val as $v): ?>
                    <td><?=$v?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td style='text-align: right' colspan='5'><?=$totalSum?></td>
        </tr>
        </tbody>
    </table>


    <form method='post' >
        <input type='text' name='first_name' placeholder='First name'  />
        <input type='text' name='last_name' placeholder='Last name' />
        <input type='email' name='email' placeholder='Email' />

        <input type='submit' value='submit'/>

    </form>

</div>
</body>
</html>

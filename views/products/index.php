<!--********** main page *********-->
<?php
require_once './models/Products.php';
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

    <form method='post' >
        <input type='text' placeholder='name of product' name='product_name' <!--value="--><?/*=$productsModel->name*/?>"/>
        <textarea name='product_description' placeholder='description' <!--value="--><?/*=$productsModel->description*/?>"></textarea>
        <input type='number' name='product_price' placeholder='price of description' <!--value="--><?/*=$productsModel->price*/?>"/>
        <input type='submit'/>
    </form>

    <form method='post'   action='/?action=users'>
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>COUNT</th>
            </tr>
            <?php foreach ($data as $val): ?>
                <tr>
                    <?php foreach ($val as $v): ?>
                        <td><?= $v ?></td>
                    <?php endforeach; ?>
                    <?php
                    $ckkey = "ckbox" . $val["Id"];
                    $ckey = 'count' . $val["Id"];
                    ?>
                    <td><input type='number' placeholder='count' name='<?= $ckey ?>' value='1' min='1' }'/></td>
                    <td><input type='checkbox' name='<?= $ckkey ?>'/></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <input type='submit' value='Buy'/>
    </form>

    <form method="post" action='/?action=orderproducts'>
        <input type="submit" value="Show All">
    </form>
</div>
</body>
</html>

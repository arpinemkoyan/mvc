<?php

namespace controllers;

use libs\DB;
use models\Orders;

class Ordersntroller extends DefaultController
{

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function selectById($id)
    {
        $productModel = new Orders();
        $data = $productModel->selectWhere('id', $id);

        return $this->loadView('orders/index', compact('data'));

    }

    public function index()
    {
        $ordersModel = new Orders();
        if ($_POST) {    /*$_GET-ov chi linum*/
            echo '******';
            print_r($_POST);
            echo '******';
            $ordersModel->name = $_POST['product_name'] ? $_POST['product_name'] : '';
            $ordersModel->description = $_POST['product_description'] ? $_POST['product_description'] : '';
            $ordersModel->price = $_POST['product_price'] ? $_POST['product_price'] : '';
            $ordersModel->insert();
            $this->redirect('/');
        }


        $data = $ordersModel->selectAll();

        return $this->loadView('products/index', compact('data', 'productsModel'));

    }


}
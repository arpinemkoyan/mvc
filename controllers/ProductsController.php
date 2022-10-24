<?php

namespace controllers;
use libs\DB;
use models\Products;

class ProductsController extends DefaultController
{

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function selectById($id)
    {
        $productModel = new Products();
        $data = $productModel->selectWhere('Id', $id);

        return $this->loadView('products/index', compact('data'));

    }

    public function index()
    {
        $productsModel = new Products();
        if ($_POST) {    /*$_GET-ov chi linum*/
            echo '******';
            print_r($_POST);
            echo '******';
            $productsModel->name = $_POST['product_name'] ? $_POST['product_name'] : '';
            $productsModel->description = $_POST['product_description'] ? $_POST['product_description'] : '';
            $productsModel->price = $_POST['product_price'] ? $_POST['product_price'] : '';
            $productsModel->insert();
            $this->redirect('/');
        }


        $data = $productsModel->selectAll();

        return $this->loadView('products/index', compact('data', 'productsModel'));

    }




}
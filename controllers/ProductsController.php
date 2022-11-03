<?php

namespace controllers;
use libs\DB;
use libs\Session;
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
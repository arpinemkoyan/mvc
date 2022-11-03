<?php

namespace controllers;
use libs\DB;
use models\Products;

class ProductsController extends DefaultController
{

    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();

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
        if (!empty($_POST)) {    /*$_GET-ov chi linum*/
            $productsModel->name = $_POST['product_name'] ?? '';
            $productsModel->description = $_POST['product_description'] ??  '';
            $productsModel->price = $_POST['product_price'] ?? '';
            $productsModel->insert();
            $this->redirect('/');
        }

        $data = $productsModel->selectAll();

        return $this->loadView('products/index', compact('data', 'productsModel'));

    }




}
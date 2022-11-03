<?php

namespace controllers;
use libs\DB;
use models\OrderProducts;

class OrderProductsController extends DefaultController
{

    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();
    }


    public function index()
    {

        $orderProducts = new OrderProducts();
        $list = $orderProducts->joinAll();

        return $this->loadView('orderproducts/index', compact('list'));

    }




}
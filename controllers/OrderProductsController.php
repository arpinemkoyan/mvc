<?php

namespace controllers;
use libs\DB;
use models\OrderProducts;

class OrderProductsController extends DefaultController
{

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();
    }


    public function index()
    {

        $orderProducts = new OrderProducts();
        $list = $orderProducts->joinAll();

        return $this->loadView('orderproducts/index', compact('list'));

    }




}
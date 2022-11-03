<?php
/*
namespace controllers;

use libs\DB;
use models\Orders;

class OrdersController extends DefaultController
{

    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();

    }

    public function selectById($id)
    {
        $ordersModel = new Orders();
        $data = $ordersModel->selectWhere('Id', $id);

        return $this->loadView('products/index', compact('data'));

    }

    public function index()
    {
        $ordersModel = new Orders();
        if ($_POST) {    /*$_GET-ov chi linum*/
//            foreach ($data as $k => $val) {
//                if (str_contains($k, 'ckbox')) {
//                    $buyId=substr($k, 5);
//                    $ordersData[$buyId]=$data['count'.$buyId];
//
//                }
//            }
//
//            $ordersModel->user_id = $_POST['user_id'] ? $_POST['user_id'] : '';
//            $ordersModel->sum = $_POST['sum'] ? $_POST['sum'] : '';
//            $ordersModel->order_date = $_POST['order_date'] ? $_POST['order_date'] : '';
//            $ordersModel->insert();
//            $this->redirect('/');
//        }
//
//
//        $data = $ordersModel->selectAll();
//
//        return $this->loadView('orders/index', compact('data', 'productsModel'));
//
//    }




//}*/
<?php

namespace controllers;

use libs\DB;
use libs\Session;
use models\Users;
use models\Orders;
use models\Products;

require_once './libs/Session.php';


class UsersController extends DefaultController
{
    private static $connect;
//    private static $session;


    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function index()
    {
        $session = Session::getInstance();
        $productsModel = new Products();
        $usersModel = new Users();
        $ordersModel = new Orders();

        if (in_array('first_name', array_keys($_POST))) {    /*$_GET-ov chi linum*/

            $usersModel->first_name = $_POST['first_name'] ? $_POST['first_name'] : '';
            $usersModel->last_name = $_POST['last_name'] ? $_POST['last_name'] : '';
            $usersModel->email = $_POST['email'] ? $_POST['email'] : '';
            $usersModel->insert();

            $userById = $usersModel->getUserByEmail($usersModel->email);
            $ordersModel->user_id = $userById['id'];
            $ordersModel->sum = $session->get('totalSum');
            $ordersModel->insert();

//            order_products
//id (int pk)
//order_id (int)
//            product_id (int)
//            qty (int)

        } else {
            $data = $_POST;
            $ordersData = [];
            foreach ($data as $k => $val) {
                if (str_contains($k, 'ckbox')) {
                    $buyId = substr($k, 5);
                    $ordersData[$buyId] = $data['count' . $buyId];
                }
            }

            $orders = [];
            $totalSum = 0;

            foreach ($ordersData as $id => $count) {
                $order = $productsModel->selectWhere('Id', $id);
                $order['count'] = $count;
                $totalSum += $count * $order['price'];
                $orders[] = $order;

            }

            $session->set('orders', $orders);
            $session->set('totalSum', $totalSum);

        }


        $orders = $session->get('orders');
        $totalSum = $session->get('totalSum');

        return $this->loadView('users/index', compact('orders', 'totalSum'));

    }


}
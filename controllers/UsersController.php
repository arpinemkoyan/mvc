<?php

namespace controllers;

use libs\DB;
use models\Users;
use models\Orders;
use models\Products;
//session_start();


class UsersController extends DefaultController
{
    public $data;
    public $totalSum;
    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function index()
    {

        $productsModel = new Products();
        $usersModel = new Users();
        $ordersModel = new Orders();

        if (in_array('first_name', array_keys($_POST))) {    /*$_GET-ov chi linum*/

            $usersModel->first_name = $_POST['first_name'] ? $_POST['first_name'] : '';
            $usersModel->last_name = $_POST['last_name'] ? $_POST['last_name'] : '';
            $usersModel->email = $_POST['email'] ? $_POST['email'] : '';
            $usersModel->insert();
            $orders = $this->data;
            $totalSum=$this->totalSum;
            $userId=$usersModel->getUserByEmail($usersModel->email);
            $ordersModel->user_id=$userId;
            $ordersModel->$_SESSION['totalSum'];
          $ordersModel->insert();
            return $this->loadView('users/index', compact('orders', 'totalSum'));

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
            $this->data = $orders;
            $this->totalSum=$totalSum;
            $_SESSION['totalSum']=$totalSum;
            return $this->loadView('users/index', compact('orders', 'totalSum'));

        }


    }


}
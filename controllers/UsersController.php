<?php

namespace controllers;

use libs\DB;
use libs\Session;
use models\OrderProducts;
use models\Users;
use models\Orders;
use models\Products;

require_once './libs/Session.php';


class UsersController extends DefaultController
{
    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();

    }

    public function index()
    {
        $session = Session::getInstance();
        $productsModel = new Products();
        $usersModel = new Users();
        $ordersModel = new Orders();
        $orderProductsModel = new OrderProducts();

        if (isset($_POST['first_name'])) {

            $usersModel->first_name = $_POST['first_name'] ?? '';
            $usersModel->last_name = $_POST['last_name'] ?? '';
            $usersModel->email = $_POST['email'] ??'';
            $usersModel->insert();

            $userById = $usersModel->getUserByEmail($usersModel->email);
            $ordersModel->user_id = $userById['id'];
//            print_r($usersModel->getId());
            $ordersModel->sum = $session->get('totalSum');
            $ordersModel->insert();

            $ordersIdCount=$session->get('ordersData');
            foreach ($ordersIdCount as $product_id=>$count){
                $orderData=$ordersModel->selectbyUserId( $userById['id']);
                $orderProductsModel->product_id=$product_id;
                $orderProductsModel->order_id=$orderData['id'];
                $orderProductsModel->qty=$count;
                $orderProductsModel->insert();
            }

        } else {
            $data = $_POST;
            $ordersData = [];
            foreach ($data as $k => $val) {
                if (str_contains($k, 'ckbox')) {
                    $buyId = substr($k, 5);
                    $session->set('product_id', $buyId);
                    $ordersData[$buyId] = $data['count' . $buyId];
                }
            }
            $session->set('ordersData', $ordersData);

            $orders = [];
            $totalSum = 0;

            foreach ($ordersData as $id => $count) {
                $order = $productsModel->selectWhere('Id', $id);
                $order['count'] = $count;
                $session->set('count', $count);
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
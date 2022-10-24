<?php

namespace controllers;
use libs\DB;
use models\Users;
use models\Orders;
use models\Products;

class UsersController extends DefaultController
{

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function selectById($id)
    {
        $productModel = new Users();
        $data = $productModel->selectWhere('id', $id);

        return $this->loadView('products/index', compact('data'));

    }

    public function index()
    {
        $usersModel = new Users();
        $productsModel = new Products();
        $data=$_POST;
        foreach ($data as $k => $val) {
            if (str_contains($k, 'ckbox')) {
                $buyId=substr($k, 5);
                $ordersData[$buyId]=$data['count'.$buyId];
            }
        }

        $totalSum=0;
        foreach ($ordersData as $id=>$count){
            $order=$productsModel->selectWhere('Id', $id);
            $order['count']=$count;
            $totalSum+=$count*$order['price'];
            $orders[]=$order;

        }
        echo '******------';
        print_r($_POST);
        echo '********----';
//        print_r(in_array('faname',array_keys($_POST), TRUE));
//        if(strpos(array_keys($_POST), 'fname')){
//            echo '############';
//        }
        if ($_POST) {    /*$_GET-ov chi linum*/
            print_r($_POST);
            $usersModel->first_name = $_POST['fname'] ? $_POST['fname'] : '';
            $usersModel->last_name = $_POST['lname'] ? $_POST['lname'] : '';
            $usersModel->email = $_POST['email'] ? $_POST['email'] : '';
            $usersModel->insert();
//            $this->redirect('/');
        }


        return $this->loadView('users/index', compact('orders', 'totalSum'));

    }




}
<?php

namespace models;
use libs\DB;
use PDO;
require_once './libs/DB.php';

class OrderProducts extends DB
{
    public $order_id;
    public $product_id;
    public $qty;
    protected $_id;

    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();

    }

    public function insert()
    {
        $sql = 'INSERT INTO order_products ( order_id, product_id, qty) VALUES(?,?,?)';
        self::$_connect->prepare($sql)->execute([$this->order_id, $this->product_id, $this->qty]);
//        $this->_id = self::$_connect->lastInsertedId();
        return $this;
    }

    public function joinAll()
    {
        $query_search = self::$_connect->prepare(" SELECT * 
            FROM order_products 
            LEFT JOIN products ON (order_products.product_id=products.Id) 
            LEFT JOIN orders ON (order_products.order_id=orders.id)
            LEFT JOIN users ON (orders.user_id=users.id)
 ");

        $query_search->execute();

        $list = $query_search->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

}

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
    protected $id;

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function insert()
    {
        $sql = 'INSERT INTO order_products ( id, order_id, product_id, qty) VALUES(?,?,?,?)';
        $ids = self::$connect->query("SELECT id FROM order_products ")->fetchAll(PDO::FETCH_ASSOC);
        $this->id = $ids ? ++array_pop($ids)['Id'] : 0;
        self::$connect->prepare($sql)->execute([$this->id, $this->order_id, $this->product_id, $this->qty]);

        return $this;
    }

    public function joinAll()
    {
        $query_search = self::$connect->prepare(" SELECT * 
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

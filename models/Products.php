<?php

namespace models;

use libs\DB;
use PDO;
require_once './libs/DB.php';

class Products extends DB
{
    public $name;
    public $description;
    public $price;
    protected $_id;

    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();

    }

    public function selectALL()
    {

        $data = self::$_connect->query("SELECT * FROM products");
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function insert()
    {

        $sql = "INSERT INTO products ( `name`, `description`, `price`) VALUES (?,?,?)";
        self::$_connect->prepare($sql)->execute([ $this->name, $this->description, intval($this->price)]);
//        $this->_id = self::$_connect->lastInsertId();
        return $this;
    }

    public function selectWhere($where, $val)
    {
        $stmt = self::$_connect->prepare("SELECT * FROM products WHERE $where=:Id");
        $stmt->execute([':Id' => $val]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;

    }

    public function whereIn($clm, $arr){

        $in=str_repeat('?, ', count($arr) - 1) . '?';
        $stmt = self::$_connect->prepare("SELECT * FROM products WHERE $clm in ($in)");
        $stmt->execute($arr);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

}
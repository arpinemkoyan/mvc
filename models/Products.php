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
    protected $id;

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function selectALL()
    {

        $data = self::$connect->query("SELECT * FROM products");
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function insert()
    {

        $sql = "INSERT INTO products (`Id`, `name`, `description`, `price`) VALUES (?,?,?,?)";
        $ids = self::$connect->query("SELECT Id FROM products")->fetchAll(PDO::FETCH_ASSOC);
        $this->id = $ids ? ++array_pop($ids)['Id'] : 0;
        self::$connect->prepare($sql)->execute([$this->id, $this->name, $this->description, intval($this->price)]);
        return $this;
    }

    public function selectWhere($where, $val)
    {
        $stmt = self::$connect->prepare("SELECT * FROM products WHERE $where=:Id");
        $stmt->execute([':Id' => $val]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;

    }


//    public function updateMessage()
//    {
//        $db = Db::getInstance();
//        $table = static::getTableName();
//        $sql = "UPDATE $table SET `message` = ?, `status` = 1 WHERE id=?";
//        return $db->query($sql, [$this->message, $this->id]);
//    }
//
//    public function approve()
//    {
//        $db = Db::getInstance();
//        $table = static::getTableName();
//        $sql = "UPDATE $table SET `status` = 1 WHERE id=?";
//        return $db->query($sql, [$this->id]);
//    }

}
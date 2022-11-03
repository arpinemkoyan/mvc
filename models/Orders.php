<?php
namespace models;
use libs\DB;
use PDO;

class Orders extends DB
{
    public $user_id;
    public $sum;
    public $order_date;
    protected $id;

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function insert()
    {

        $sql = "INSERT INTO orders (`id`, `user_id`, `sum`, `order_date`) VALUES (?,?,?,?)";
        $ids = self::$connect->query("SELECT id FROM orders")->fetchAll(PDO::FETCH_ASSOC);
        $this->id = $ids ? ++array_pop($ids)['id'] : 0;
        $this->order_date= date("Y-m-d h:i:sa") ;
        self::$connect->prepare($sql)->execute([$this->id, $this->user_id, $this->sum, $this->order_date]);
        return $this;

    }

    public function getById()
    {
        self::$connect->lastInsertId(200);
        return self::$connect->lastInsertId();
        $query = self::$connect->prepare('SELECT * FROM orders WHERE user_id = :id');
        $query->execute(['id' => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }
    }
    public function selectbyUserId( $val)
    {
        $stmt = self::$connect->prepare("SELECT * FROM orders WHERE user_id=?");
        $stmt->execute([$val]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        return $order;

    }


//    public function selectALL()
//    {
//
//        $data = self::$connect->query("SELECT * FROM products");
//        $result = $data->fetchAll(PDO::FETCH_ASSOC);
//
//        return $result;
//
//    }
//
//    public function insert()
//    {
//
//        $sql = "INSERT INTO products (`Id`, `name`, `description`, `price`) VALUES (?,?,?,?)";
//        $ids = self::$connect->query("SELECT Id FROM products")->fetchAll(PDO::FETCH_ASSOC);
//        $this->id = $ids ? ++array_pop($ids)['Id'] : 0;
//
//        self::$connect->query($sql, [$this->id, $this->name, $this->description, $this->price]);
//        return $this;
//    }
//
//    public function selectWhere($where, $val)
//    {
//        $stmt = self::$connect->prepare("SELECT * FROM orders WHERE $where=:Id");
//        $stmt->execute([':Id' => $val]);
//        $product = $stmt->fetch(PDO::FETCH_ASSOC);
//
//        return $product;
//
//    }
//
//}

}
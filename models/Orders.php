<?php
namespace models;
use libs\DB;
use PDO;

class Orders extends DB
{
    public $user_id;
    public $sum;
    public $order_date;
    protected $_id;

    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();

    }

    public function insert()
    {

        $sql = "INSERT INTO orders ( `user_id`, `sum`, `order_date`) VALUES (?,?,?)";
        $this->order_date= date("Y-m-d h:i:sa") ;
        self::$_connect->prepare($sql)->execute([ $this->user_id, $this->sum, $this->order_date]);
//        $this->_id = self::$_connect->lastInsertedId();

        return $this;

    }

    public function getById()
    {
        self::$_connect->lastInsertId(200);
        return self::$_connect->lastInsertId();
        $query = self::$_connect->prepare('SELECT * FROM orders WHERE user_id = :id');
        $query->execute(['id' => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }
    }
    public function selectbyUserId( $val)
    {
        $stmt = self::$_connect->prepare("SELECT * FROM orders WHERE user_id=?");
        $stmt->execute([$val]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        return $order;

    }

}
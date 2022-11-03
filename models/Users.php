<?php

namespace models;

use libs\DB;
use PDO;
require_once './libs/DB.php';

class Users extends DB
{
    public $first_name;
    public $last_name;
    public $email;
    protected $_id;

    private static $_connect;

    public function __construct()
    {
        self::$_connect = DB::getInstance();

    }

    public function selectALL()
    {

        $data = self::$_connect->query("SELECT * FROM users");
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function insert()
    {
        $sql = "INSERT INTO users ( `first_name`, `last_name`, `email`) VALUES (?,?,?)";
        self::$_connect->prepare($sql)->execute([ $this->first_name, $this->last_name, $this->email]);
//        print_r(self::$_connect->lastInsertedId());
//        $this->_id = self::$_connect->lastInsertedId();

        return $this;

    }

    public function selectWhere($where, $val)
    {
        $stmt = self::$_connect->prepare("SELECT * FROM users WHERE $where=:vla");
        $stmt->execute([':val' => $val]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;

    }

        public function getUserByEmail($email)
    {
        $query = self::$_connect->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' => $email]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }
    }

    public function getId(){
        return self::$_connect->lastInsertId();
    }

}
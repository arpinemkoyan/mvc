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
    protected $id;

    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function selectALL()
    {

        $data = self::$connect->query("SELECT * FROM users");
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function insert()
    {
        $sql = "INSERT INTO users (`id`, `first_name`, `last_name`, `email`) VALUES (?,?,?,?)";
        $ids = self::$connect->query("SELECT id FROM users")->fetchAll(PDO::FETCH_ASSOC);
        $this->id = $ids ? ++array_pop($ids)['id'] : 0;
        self::$connect->prepare($sql)->execute([$this->id, $this->first_name, $this->last_name, $this->email]);
        return $this;

    }

    public function selectWhere($where, $val)
    {
        $stmt = self::$connect->prepare("SELECT * FROM users WHERE $where=:vla");
        $stmt->execute([':val' => $val]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;

    }

        public function getUserByEmail($email)
    {
        $query = self::$connect->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' => $email]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }
    }


}
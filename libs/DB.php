<?php

namespace libs;

use PDO;
use PDOException;

class DB
{
    private $_servername = "127.0.0.1";
    private static $_username = "root";
    private static $_password = "";
    private $_dbName = "db";

    protected static $_instance;
    protected static $_instances;


    private function __construct()
    {

        try {
            self::$_instance = new PDO("mysql:host=$this->_servername;dbname=$this->_dbName;charset=UTF8", self::$_username, self::$_password);
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$_instance) {
            new DB();
        }

        return self::$_instance;
    }

    public static function getInstanceCall()
    {
        $class = get_called_class();

        if (!isset($_instances[$class])) {
            self::$_instances[$class] = new $class();
        }

        return self::$_instances[$class];
    }

}


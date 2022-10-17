<?php


class DB
{
    private $servername = "127.0.0.1";
    private static $username = "root";
    private static $password = "";
    private $dbName = "db";

    protected static $instance;
    protected static $instances;


    private function __construct()
    {

        try {
            self::$instance = new PDO("mysql:host=$this->servername;dbname=$this->dbName;charset=UTF8", self::$username, self::$password);
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            new DB();
        }

        return self::$instance;
    }

    public static function getInstanceCall()
    {
        $class = get_called_class();

        if (!isset($instances[$class])) {
            self::$instances[$class] = new $class();
        }

        return self::$instances[$class];
    }

}
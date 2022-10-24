<?php


class Users extends DB1
{
    private static $connect;

    function __construct()
    {
        self::$connect = DB1::getInstance();

    }

    public function insert($insertData)
    {
        $insertData = array_values($insertData);

        $sql = 'INSERT INTO users( id,first_name, last_name,email) VALUES(:id,:first_name, :last_name, :email)';
        $ids = self::$connect->query("SELECT id FROM users")->fetchAll(PDO::FETCH_ASSOC);

        $id = $ids ? ++array_pop($ids)['id'] : 0;

        $statement = self::$connect->prepare($sql);
        $statement->execute([
            ':id' => $id,
            ':first_name' => $insertData[0],
            ':last_name' => $insertData[1],
            ':email' => $insertData[2]
        ]);

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
<?php


class Products extends DB
{
    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function select()
    {

        $data = self::$connect->query("SELECT * FROM products");
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function insert($data)
    {

        $data = array_values($data);
        $sql = 'INSERT INTO products( Id,name, description, price) VALUES(:Id,:name, :description, :price)';
        $ids = self::$connect->query("SELECT Id FROM products")->fetchAll(PDO::FETCH_ASSOC);

        $id = $ids ? ++array_pop($ids)['Id'] : 0;

        $statement = self::$connect->prepare($sql);
        $statement->execute([
            ':Id' => $id,
            ':name' => $data[0],
            ':description' => $data[1],
            ':price' => $data[2]
        ]);

    }

    public function selectById($id)
    {
        $stmt = self::$connect->prepare("SELECT * FROM products WHERE Id=:Id");
        $stmt->execute([':Id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;

    }

}
<?php


class Orders extends DB
{
    private static $connect;

    function __construct()
    {
        self::$connect = DB::getInstance();

    }

    public function insert($orderData)
    {
        $data = array_values($orderData);
        $sql = 'INSERT INTO orders( id, user_id, sum, order_date) VALUES(:id, :user_id, :sum, :order_date)';
        $ids = self::$connect->query("SELECT id FROM orders")->fetchAll(PDO::FETCH_ASSOC);

        $id = $ids ? ++array_pop($ids)['id'] : 0;

        $statement = self::$connect->prepare($sql);
        $statement->execute([
            ':id' => $id,
            ':user_id' => $data[1],
            ':sum' => $data[0],
            ':order_date' => date("Y-m-d h:i:sa") /*jamy sxal e*/
        ]);

    }

    public function getById($id)
    {
        $query = self::$connect->prepare('SELECT * FROM orders WHERE user_id = :id');
        $query->execute(['id' => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        }
    }

}
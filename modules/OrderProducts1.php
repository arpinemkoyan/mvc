<?php


class OrderProducts extends DB1
{
    private static $connect;

    function __construct()
    {
        self::$connect = DB1::getInstance();

    }

    public function insert($data)
    {
        $data = array_values($data);
        $sql = 'INSERT INTO order_products ( id, order_id, product_id, qty) VALUES(:id, :order_id, :product_id, :qty)';
        $ids = self::$connect->query("SELECT id FROM order_products ")->fetchAll(PDO::FETCH_ASSOC);

        $id = $ids ? ++array_pop($ids)['id'] : 0;

        $statement = self::$connect->prepare($sql);
        $statement->execute([
            ':id' => $id,
            ':order_id' => $data[1],
            ':product_id' => $data[0],
            ':qty' => $data[2]
        ]);

    }

    public function joinAll()
    {
        $query_search = self::$connect->prepare(" SELECT * 
        FROM order_products 
        LEFT JOIN products ON (order_products.product_id=products.Id) 
        LEFT JOIN orders ON (order_products.order_id=orders.id)
        LEFT JOIN users ON (orders.user_id=users.id)
 ");

        $query_search->execute();

        $list = $query_search->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

}
<?php

class Product extends BaseModel {

    protected $table = 'products';
    protected $pk = 'id';

    public static function placeOrder($product_id, $amount, $first_name, $last_name, $email, $unit_price){
        global $db;

        $sql = 'INSERT INTO `orders` (firstname, lastname, email) values (:firstname, :lastname, :email)';
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute(
            [
                ':firstname' => $first_name,
                ':lastname' => $last_name,
                ':email' => $email,
            ]
        );

        $order_id = $db->lastInsertId(); 

        if($order_id) {
            $sql = 'INSERT INTO `order_details` (order_id, product_id, amount, unit_price) values (:order_id, :product_id, :amount, :unit_price)';
            $pdo_statement = $db->prepare($sql);
            $pdo_statement->execute(
                [
                    ':order_id' => $order_id,
                    ':product_id' => $product_id,
                    ':amount' => $amount,
                    ':unit_price' => $unit_price,
                ]
            );
        }
        
        return $order_id;
    }
}
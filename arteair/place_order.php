<?php

require_once 'db.php';
$success = true;

if(isset($_POST['flight_id'])) 
{
    $flight_id = (int) $_POST['flight_id'];
    $firstname = htmlentities($_POST['firstname']);
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try { 
        $db->beginTransaction();

        //run query
        $sql = 'INSERT INTO `orders` 
                (`firstname`, `lastname`, `email`, `order_date`)
                VALUES
                (:firstname, :lastname, :email, :date)';

        $sth = $db->prepare($sql);
        $sth->execute([
            ':date' => date("Y-m-d H:i:s"),
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email,
        ]);

        $order_id = $db->lastInsertId();

        if($order_id) {
            $sql = 'INSERT INTO `order_detail` 
                (`order_id`, `flight_id`, `seat`)
                VALUES
                (:order_id, :flight_id, :seat)';

            $sth = $db->prepare($sql);

            foreach($_POST['seat'] as $seat) {
                $parameters = [
                    ':order_id' => $order_id,
                    ':flight_id' => $flight_id,
                    ':seat' => $seat,
                ];

                $sth->execute($parameters);
            }

            $db->commit();
        } 
 
        header('Location: /arteair/order_done.php?order_id=' . $order_id);
    } catch (Exception $e) {
        $db->rollBack();
        echo "Something went wrong: " . $e->getMessage();
    }

     
}


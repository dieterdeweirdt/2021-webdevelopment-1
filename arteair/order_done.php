<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once 'db.php';

    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
    }

    $sql = 'SELECT *
            FROM `orders` 
            WHERE orders.order_id = :order_id';

    $sth = $db->prepare($sql);
    $sth->execute([':order_id' => $order_id]);
    $order = $sth->fetchObject();

    $sql = 'SELECT `order_detail`.*, flight.*, aircraft.*, a1.name as from_name, a1.airport_code as from_code, a2.name as to_name, a2.airport_code as to_code
            FROM `order_detail`
            INNER JOIN flight ON flight.flight_id = order_detail.flight_id 
            INNER JOIN aircraft ON flight.aircraft_id = aircraft.aircraft_id
            INNER JOIN airport a1 ON flight.from = a1.airport_id
            INNER JOIN airport a2 ON flight.to = a2.airport_id
            WHERE order_detail.order_id = :order_id';

    $sth = $db->prepare($sql);
    $sth->execute([':order_id' => $order_id]);
    $order_details = $sth->fetchAll();

    if(isset($_GET['output']) && $_GET['output'] == 'pdf') {

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(get_order_detail());
        $mpdf->Output();

    } else {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Order</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="/arteair/main.css?v=<?php echo time(); ?>">

        </head>
        <body>
        <?php include 'partials/header.php'; ?>

        <section>
            <?php echo get_order_detail(); ?>
            <a href="./index.php">Startpagina</a>
        </section>
        </body>
        </html>
        <?php 
    } 


function get_order_detail(){
   global $order, $order_details;

   $output = '<h1>' . $order->firstname . ', bedankt voor uw bestelling</h1>';

    foreach($order_details as $order_detail) {
        $output .= '<div class="ticket">
            <div class="info"><h2>' 
            . $order_detail['from_code'] . ' -> ' . $order_detail['to_code'] . '
            </h2>' . $order_detail['order_date'] . '
            <br>' . $order_detail['seat'] . '
            <br>' . $order->firstname . ' '. $order->lastname . '</div>
            <div class="code"><img src="/arteair/qrcode.php?value=' . $order_detail['flight_id'] . '-' . $order_detail['seat'] . '"></div>
        </div>';
    }

    return $output;
  
}
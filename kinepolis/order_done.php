<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once 'db.php';

    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
    }

    $sql = 'SELECT *
            FROM `order` 
            WHERE order.order_id = :order_id';

    $sth = $db->prepare($sql);
    $sth->execute([':order_id' => $order_id]);
    $order = $sth->fetchObject();

    $sql = 'SELECT *
            FROM `order_detail`
            INNER JOIN schedule ON schedule.schedule_id = order_detail.schedule_id 
            INNER JOIN movie ON schedule.movie_id = movie.movie_id 
            INNER JOIN room ON room.room_id = schedule.room_id 
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
            <link rel="stylesheet" href="./main.css?v=<?php echo time(); ?>">

        </head>
        <body>
        <section>
            <?php echo get_order_detail(); ?>

            <a href="./order_done.php?output=pdf&order_id=<?php echo $order_id; ?>" download>Download als pdf</a>
            <a href="./index.php">Startpagina</a>
        </section>
        </body>
        </html>
        <?php 
    } 


function get_order_detail(){
   global $order, $order_details;

   $output = '<h1>' . $order->firstname . ', bedankt voor uw bestelling</h1>

    <table>
        <tr>
            <th>movie</th>
            <th>date</th>
            <th>room</th>
            <th>seat</th>
            <th>qr</th>
        </tr>';

        foreach($order_details as $order_detail) {
            $output .= '<tr>
                <td>' . $order_detail['title'] . '</th>
                <td>' . $order_detail['start_date'] . '</td>
                <td>' . $order_detail['name'] . '</td>
                <td>' . $order_detail['seat'] . '</td>
                <td><img src="./qrcode.php?value=' . $order_detail['start_date'] . '-' . $order_detail['name'] . '-' . $order_detail['seat'] . '"></td>
            </tr>';
        }
    $output .= "</table>";

    return $output;
  
}
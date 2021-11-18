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
<div class="flights">
    <?php
        require_once 'db.php';
        setlocale(LC_ALL, 'nl_NL');

        $sql = 'SELECT flight.*, aircraft.*, a1.name as from_name, a1.airport_code as from_code, a2.name as to_name, a2.airport_code as to_code
            FROM flight 
            INNER JOIN aircraft ON flight.aircraft_id = aircraft.aircraft_id
            INNER JOIN airport a1 ON flight.from = a1.airport_id
            INNER JOIN airport a2 ON flight.to = a2.airport_id';

        $sth = $db->prepare($sql);
        $sth->execute([]);
        $flights = $sth->fetchAll();

        $money_formatter = new \NumberFormatter( 'nl_BE', \NumberFormatter::CURRENCY );

    
       foreach($flights as $flight) :
    ?>
    <a href='/arteair/order.php?flight_id=<?php echo $flight['flight_id'] ?>' class="flight">
        <h2><?php echo $flight['from_name'] . ' -> '. $flight['to_name'] ?> (<?php echo $flight['from_code'] . ' -> '. $flight['to_code'] ?>)</h2>
        <?php 
        $date = new DateTime($flight['flight_date']);
        echo $date->format('l j F Y H:i');
            ?> &bull; <?php echo $money_formatter->format($flight['ticket_price']) ?><br>
        <?php echo $flight['aircraft_code'] ?> &bull; <?php echo $flight['model'] ?>

    
    </a>
    <?php endforeach; ?>
</div>
</section>
</body>
</html>
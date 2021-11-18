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
    <?php
        require_once 'db.php';

        $schedule_id = 1;
        if(isset($_GET['schedule_id'])){
            $schedule_id = $_GET['schedule_id'];
        }

        $sql = 'SELECT *
                FROM schedule 
                INNER JOIN movie ON schedule.movie_id = movie.movie_id
                INNER JOIN room ON schedule.room_id = room.room_id
                WHERE schedule.schedule_id = :schedule_id';

        $sth = $db->prepare($sql);
        $sth->execute([':schedule_id' => $schedule_id]);
        $schedule = $sth->fetchObject();

        $sql = 'SELECT seat
                FROM order_detail 
                WHERE order_detail.schedule_id = :schedule_id';

        $sth = $db->prepare($sql);
        $sth->execute([':schedule_id' => $schedule_id]);
        $ordered_seats = $sth->fetchAll(PDO::FETCH_COLUMN, 0); //enkel de eerste kolom ophalen hierdoor krijg ik een gewone array

    ?>

<h1><?php echo $schedule->title ?></h1>
<h3><?php echo $schedule->start_date ?> - <?php echo $schedule->name ?></h3>

<form method="POST" action="./place_order.php">
    <div class="seats">
        <?php 
        for($row = $schedule->rows; $row > 0; $row--) {
            echo '<div class="row"><span>' . $row . '</span>';
            for($column = 1; $column <= $schedule->seats; $column++) {
                $seat_ref = str_pad($row, 2, "0", STR_PAD_LEFT) .';' . str_pad($column, 2, "0", STR_PAD_LEFT);
                if(in_array($seat_ref, $ordered_seats)) {
                    echo '<div class="seat seat-ordered"></div>';
                } else {
                    echo '<div class="seat"><input type="checkbox" name="seat[]" value="' . $seat_ref .'"></div>';
                }
            }
            echo '</div>';
        }
        ?>
    </div>

    Uw voornaam:   <input type="text" name="firstname" >  <br>
    Uw naam:   <input type="text" name="lastname">  <br>
    Uw e-mail:   <input type="text" name="email" >  <br>
    <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
    <button type="submit">Bestelling afwerken</button>
                                    
</form>
</section>
</body>
</html>
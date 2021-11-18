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
<div class="movies">
    <?php
        require_once 'db.php';

        $sql = 'SELECT *
                FROM schedule 
                INNER JOIN movie ON schedule.movie_id = movie.movie_id
                INNER JOIN room ON schedule.room_id = room.room_id';

        $sth = $db->prepare($sql);
        $sth->execute([]);
        $movies = $sth->fetchAll();

       foreach($movies as $movie) :
    ?>
    <div class="movie">
        <h2><?php echo $movie['title'] ?></h2>
        <p>
            <?php echo $movie['start_date'] ?><br>
            <?php echo $movie['name'] ?>
        </p>
        <a href='./order.php?schedule_id=<?php echo $movie['schedule_id'] ?>'>Bestel tickets</a>
    </div>
    <?php endforeach; ?>
</div>
</section>
</body>
</html>
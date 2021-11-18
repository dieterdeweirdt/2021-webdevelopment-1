<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/main.css">

</head>
<body>
    <h1>Movies</h1>
<?php foreach ($movies as $movie) { ?>
    <p><a href="/movie/detail.php?movie_id=<?= $movie['movie_id']; ?>">
        <?= $movie['title']; ?>
    </a></p>
<?php } ?>

<a href="../">&lt; Back</a>

</body>
</html>
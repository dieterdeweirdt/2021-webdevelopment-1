<?php
require '../app.php';

$location = new Location();

$locations = $location->getAll();
?>
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
    <h1>Locations</h1>
<?php foreach ($locations as $location) { ?>
    <p><a href="/location/detail.php?location_id=<?= $location['location_id']; ?>">
        <?= $location['name']; ?>
    </a></p>
<?php } ?>

<a href="../">&lt; Back</a>

</body>
</html>
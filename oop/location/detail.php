<?php
require '../app.php';

$location = new Location();


if(isset($_POST['btnUpdate'])) {
    echo 'test';
    $location->update();
}

$location->getById($_GET['location_id']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    
<h1>Edit location</h1>
<form method="POST">
<p>
    <label for="name">Title:</label><br>
    <input type="text" id="" name="name" value="<?= $location->name; ?>">
</p>
<p>
    <label for="street">street:</label><br>
    <input type="text" id="street" name="street" value="<?= $location->street; ?>">
</p>
<p>
    <label for="city">city:</label><br>
    <input type="text" id="city" name="city" value="<?= $location->city; ?>">
</p>
<button type="submit" name="btnUpdate">Edit</button>
</form>

<a href="list.php">&lt; Back</a>


</body>
</html>
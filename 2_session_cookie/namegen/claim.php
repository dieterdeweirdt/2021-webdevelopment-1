<?php

$my_name = $_POST["my_name"];

setcookie('claimed', $my_name, time() + 3600);

header("Location: /week02/namegen/index.php");
die();

?>
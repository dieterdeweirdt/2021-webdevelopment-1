<?php

require '../includes/db.php';

$file_name = '';
if(isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) 
{
    //bestandsnaam van het opgeladen betand
    $file_name = $_FILES['photo']["name"];
    //splits de bestandsnaam in de naam en extentie
    $file_info = pathinfo($file_name);
    //De plaats waar het bestand momenteel tijdelijk opgeladen is
    $tmp_location = $_FILES['photo']["tmp_name"];
    //De plaats waar
    $new_location = '../images/' . $file_name;
    move_uploaded_file($tmp_location, $new_location);
}

$tweet = $_POST['tweet'] ?? '';

$sql = 'INSERT INTO `message` (`user_id`, `message`, `photo`, `created_on`)
VALUES (:user_id, :message, :photo, :created_on)';

$stmnt = $db->prepare($sql);
$stmnt->execute(
    [
        ':user_id' => 122,
        ':message' => $tweet,
        ':photo' => $file_name,
        ':created_on' => date('Y-m-d H:i:s')
    ]
);

header('location: ../index.php');
die();

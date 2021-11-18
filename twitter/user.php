<?php 
setlocale(LC_ALL, 'nl_BE');

$user_id = $_GET['user_id'] ?? 0;

if( ! $user_id ) {
    //redirect to home
    header('location: index.php');
    die();
}

require 'includes/db.php';

$sql = 'SELECT *
FROM `message` 
INNER JOIN `users` ON message.user_id = `users`.`user_id`
WHERE `users`.`user_id` = :id
ORDER BY `created_on` DESC 
LIMIT 25';

$stmnt = $db->prepare($sql);
$stmnt->execute(
    [ ':id' => $user_id ]
);
$messages = $stmnt->fetchAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PGM Tweets</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="messages">
        
        <?php foreach($messages as $message) {
            include 'views/message.php';
        } ?>
    </div>

</div>

</body>
</html>
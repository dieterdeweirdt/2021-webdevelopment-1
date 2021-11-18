<?php 
setlocale(LC_ALL, 'nl_BE');

require 'includes/db.php';


$sql = 'SELECT *
FROM `message` 
INNER JOIN `users` ON message.user_id = `users`.`user_id`
ORDER BY `created_on` DESC 
LIMIT 25';

$stmnt = $db->prepare($sql);
$stmnt->execute();
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
        <form method="POST" action="api/add_tweet.php" enctype="multipart/form-data">
            <div class="message message-new">
            
                <div class="avatar">JD</div>

                <div class="content">
                    <textarea name="tweet"></textarea>
                    <input type="file" name="photo">
                    <button type="submit">Tweet</button>
                </div>
            </div>
        </form>

        <form>
            <div class="search">
                <div class="content">
                    
                    <input value="<?= $search; ?>" name="search_string" placeholder="Zoekterm">
                    <button type="submit">Zoeken</button>
                </div>
            </div>
        </form>

        <?php foreach($messages as $message) {
            include 'views/message.php';
        } ?>
    </div>

</div>

</body>
</html>
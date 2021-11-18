<?php
require_once 'config.php';

$file = $_GET['file'];
$content = file_get_contents($file);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DarkShare</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<h1>DarkShare</h1>

<section>
<form>
<textarea rows='40' style="width:100%"><?= $content?></textarea>
<input type="hidden" name="file">
<input type="submit" value="Update" class="btn">
<a href="index.php">Annuleer</a>
</form>
</section>

</body>
</html>

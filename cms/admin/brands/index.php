<?php
require_once '../../app.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Brands</h1>

    <?php 

    

        $all_brands = Brand::all();

        var_dump($all_brands);

        $all_brands = Product::all();

        var_dump($all_brands);

    ?>
    
</body>
</html>
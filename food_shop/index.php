<?php require 'app.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
<h1>Out of stock</h1>

<div class="list">
<?php
$stmnt = $db->prepare("Select * From products Where stock <= 0 OR stock IS NULL"); 
if($stmnt) {
    $success = $stmnt->execute( [  ] );

    if($success) {
        $result = $stmnt->fetchAll();

        foreach($result as $product)  {
            $product =  (object) $product;
            include 'view/product.php';
        }

    }
} 
?>
</div>
    
<h1>Aantal bestellingen 2021</h1>

<div class="list">
<?php
$stmnt = $db->prepare("select  DATE_FORMAT(order_date, '%y-%m') as 'yymm', count(orders.id) as number_of_orders
from orders
where YEAR(order_date) = 2021
group by yymm
order by yymm ASC"); 
if($stmnt) {
    $success = $stmnt->execute( [  ] );

    if($success) {
        $result = $stmnt->fetchAll();

        foreach($result as $item)  {
            $item =  (object) $item;
            ?>
            <div class="item">
                <span><?= $item->yymm; ?></span>
                <span><?= $item->number_of_orders; ?></span>
                
            </div>
            <?php
        }

    }
} 
?>
</div>
    
</body>
</html>
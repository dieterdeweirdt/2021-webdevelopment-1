<?php
 require_once 'app.php';


if(isset($_GET['product_code']) && isset($_GET['price'])) {
    print_r($_GET['product_code']);
}
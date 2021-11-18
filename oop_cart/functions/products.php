<?php

function getProductsGrid(array $products )  {
    echo '<div class="products">';
    foreach ($products as $key => $product) {
        $product = (object) $product;
        include 'views/product_item.php';
    }
    echo '</div>';
}
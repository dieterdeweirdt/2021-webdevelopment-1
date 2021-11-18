<?php

function getCartOverview(array $items )  {
    echo '<div class="cart">';
    echo '<div class="cart-item car-item-header">
    <span>Product</span>
    <span>Price</span>
    <span>Quantity</span>
    <span>Subtotal</span>
    <span>Quantity</span>
    </div>';
    foreach ($items as $key => $item) {
        include 'views/cart_item.php';
    }
    echo '</div>';
}
<div class="cart-item">
    <span><strong><?php echo $item->product_code; ?></strong></span>
    <span>&euro; <?php echo $item->price; ?></span>
    <span><?php echo $item->quantity; ?></span>
    <span>&euro; <?php echo $item->getSubTotal(); ?></span>
    <span><a href="<?php echo BASE_PATH; ?>remove_from_cart.php?key=<?php echo $key; ?>">Remove cart</a></span>
</div>
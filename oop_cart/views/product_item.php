<div class="product_item">
    
    <img src="<?php echo $product->photo; ?>">
    <h2><?php echo $product->name; ?></h2>
    &euro; <?php echo $product->price; ?>
    <a href="<?php echo BASE_PATH; ?>add_to_cart.php?product_code=<?php echo $product->code; ?>&price=<?php echo $product->price; ?>">Add to cart</a>
</div>
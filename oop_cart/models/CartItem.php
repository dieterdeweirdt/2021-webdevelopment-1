<?php

class CartItem {
    public $product_code;
    public $price;
    public $quantity;

    public function __construct( string $a_product_code, float $a_price, int $a_quantity = 1) {
        $this->product_code = $a_product_code;
        $this->price        = $a_price;
        $this->quantity     = $a_quantity;
    }

    public function getSubTotal() : float {
        $subTotal = $this->price * $this->quantity;
        return $subTotal;
    }

}
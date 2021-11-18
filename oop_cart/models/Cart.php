<?php

class Cart {

    private $items;

    public function __construct() {
        //Indien er een cookie is lees die uit en vul $this->items in
        if(isset($_COOKIE['cart'])) {
            $this->items = unserialize($_COOKIE['cart']);
        } 
        //Indien undefined of false, maak een lege array aan
        if( !$this->items ) {
            $this->items = [];
        }
    }

    public function add(CartItem $item) {
        $isNew = true;

        foreach($this->items as $key => $value){ 
            if ( $value->product_code === $item->product_code) {
                //update quanity for excisting product_codes
                $value->quantity += $item->quantity;
                $isNew = false; 
            }
        }
        //only add new products
        if($isNew) {
            $this->items[] = $item;
        }
        // Update cookie
        $this->updateCookie();
    }

    public function remove($item) {
        
        if(is_int($item)) {
            //remove by key
            array_splice($this->items, $item, 1); 
        }
        else {
            //remove by CartItem
            foreach($this->items as $key => $value){ 
                if ( $value->product_code === $item->product_code) {
                    array_splice($this->items, $key, 1); 
                }
            }
        }
        $this->updateCookie();
    }

    public function getCartItems() : array {
        
        return $this->items;
    }
    
    public function setItems($input) {
        if(is_string($input)) {
            $this->items = explode(',', $input);
        }else {
            $this->items = $input;
        }
    }

    public function getTotalPrice() : float {
        $total = 0;

        //todo calc total
        foreach ( $this->items as $item ) {
            //$total = $total + $item->getSubTotal();
            $total += $item->getSubTotal();

        }

        return $total;
    }

    public function getNumberOfItems() : int {
        $total = 0;

        //todo calc total quantity
        foreach ( $this->items as $item ) {
            $total += $item->quantity;

        }

        return $total;
    }

    private function updateCookie() {
        // cookie wegschrijven as string/json of csv
        setcookie('cart', serialize($this->items));
    }

}
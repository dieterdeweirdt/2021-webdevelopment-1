<?php


class Product extends Model {

    protected $table = 'product';
    protected $primaryKey = 'product_id';

    public function __construct()
    {
        echo __CLASS__, ' zegt: \'Hallo, Wereld!\'', PHP_EOL;
    }

    
}
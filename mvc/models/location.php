<?php

class Location extends dbModel {
  
    public function __construct() {
        $this->table = 'location';
        $this->pk = 'location_id';
    }


}
<?php

class Location extends dbModel {
  
    public function __construct() {
        $this->table = 'location';
        $this->pk = 'location_id';
    }

    public function update($fields = []) {
        //TODO update with the $_POST values

        echo 'Dit is de update van Location';
        $fields = [];
        $fields['name'] = $_POST['name'] ?? '';

        parent::update($fields);
    }

}
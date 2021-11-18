<?php

class Movie extends dbModel {

    public function __construct() {
        $this->table = 'movie';
        $this->pk = 'movie_id';
    }


}
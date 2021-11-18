<?php

class MovieController {

    public function index() {
        echo 'Dit is de lijst pagina controller';
    }

    public function detail($slug) {
        $movie = new Movie();
        $movie->getById(1);
        print_r($movie);
        include 'views/movie/detail.php';
    }
}
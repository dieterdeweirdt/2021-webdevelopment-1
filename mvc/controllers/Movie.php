<?php

class MovieController extends PageController {

    public function index() {
        $movie = new Movie();
        $movies = $movie->getAll();

        $this->loadView('movie/list', [
            'movies' => $movies
        ]);
    }

    public function detail($slug) {
        $movie = new Movie();
        $movie->getById(1);

        $this->loadView('movie/detail', [
            'movie' => $movie
        ]);
    }
}
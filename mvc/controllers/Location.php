<?php

class LocationController extends PageController {

    public function index() {
        $location = new Location();
        $locations = $location->getAll();

        $this->loadView('location/list', [
            'locations' => $locations
        ]);
    }

  
}
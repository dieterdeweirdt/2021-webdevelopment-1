<?php

require 'app.php';
$user_id = 1; //vaste gebruiker -> TODO: gebruikers moeten inloggen en id moet in session zitten

if(isset($_GET['car_id'])) {
    if(isset($_GET['remove'])) {
        Car::removeFromFavorites($_GET['car_id'], $user_id);
    } else {
        //eerst controle of de wagen al een favoriet is... anders krijgen we een foutmelding van duplicate PK
        if(!Car::isFavorite($_GET['car_id'], $user_id)) {
            Car::addToFavorites($_GET['car_id'], $user_id);
        }
    }
    header('location:detail.php?id=' .$_GET['car_id']);
}
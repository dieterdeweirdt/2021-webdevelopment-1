<?php

    // Foutmeldingen
    error_reporting(0); // Standaardfoutmelding afzetten.
    try {               // Eigen foutmelding.
        // Verbinding maken met de database via een nieuwe PDO.
        $db = new PDO(DB_DSN, DB_USER, DB_PWD);
    } catch (PDOException $exception) {
        die('Databaseverbinding mislukt: ' . $exception->getMessage());
    }

    /*
    * Alle foutmeldingen weer aanzetten, inclusief die van PDO.
    * Gebruik deze opties NOOIT op een productieserver, want dit is een schat aan informatie voor hackers!
    */
    error_reporting(E_ALL);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
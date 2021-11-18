<?php

include 'db.php';

//sql
$sql = 'SELECT * FROM arteair.flight';

//prepare
$stmnt = $db->prepare($sql);

//execute
$stmnt->execute( [] );

//data fetchen
$flights = $stmnt->fetchAll();

foreach($flights as $flight) {
    echo '<br>' . $flight['flight_id'] . ' -> ' . $flight['flight_date'];
}
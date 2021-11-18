<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NMT 1 - Week 01</title>
</head>
<body>

<h1>NMT 1 - Week 01</h1>


<?php
    //Variabele geslacht aanmaken
    $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';

    // vergelijking van variabele als dit anders dat
    if ( $gender == 'm' ) {
        aanspreking('boy', 'Howest');
    } elseif ( $gender == 'v') {
        aanspreking('girl');
    } else {
        aanspreking('you');
    }

    // Wissel afhankelijk van waarde variabele
    switch ( $gender ) {
        case 'm' :  
            aanspreking('boy', 'Howest');
            break; // ga uit de switch
        case 'v' :
            aanspreking('girl');
            break; // ga uit de switch
        default :
            aanspreking('you');
    }
    
    // Een functie bevat code die dan op meerdere plaatsen kan uitgevoerd worden
    // Deze kan parameters (arguments) vragen
    function aanspreking( $input , $school = 'Artevelde' ) {
        echo 'Hi ' . $input . ' at ' . $school ;
    }

?>

</body>
</html>
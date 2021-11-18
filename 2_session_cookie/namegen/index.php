<?php 
require_once 'data.php';

session_start();

//Random layout
$random_font = $font[array_rand($font)];
$random_color = 'hsla(' . rand(0, 360) . ', ' . rand(55, 65) . '%, ' . rand(55, 65) . '%, 1)';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Namegen</title>
    <link href="https://fonts.googleapis.com/css?family=<?php echo  str_replace(' ', '+', $random_font); ?>" rel="stylesheet">
    <link href="/week02/namegen/css/name_generator.css" rel="stylesheet">
    <style>
        body { 
            background: <?php echo  $random_color; ?>; 
            font-family: '<?php echo  $random_font; ?>', helvetica, sans-serif;
        }
    </style>
</head>
<body>
<header>
    <h2><?php echo  $random_color; ?>, <a href="https://fonts.google.com/specimen/<?php echo  str_replace(' ', '+', $random_font); ?>" target="_blank"><?php echo  $random_font; ?></a></h2>
</header>
    <?php 
    
    $previous = '';
    if ( isset($_SESSION["previous"]) ) {
        $previous = $_SESSION["previous"];
    }

    $claimed = '';
    if ( isset($_COOKIE["claimed"]) ) {
        $claimed = $_COOKIE["claimed"];
    }

    if($claimed) {
        echo '<section><h2>You already claimed: ' . $claimed . '</h2></section>';
    } else {

        do {
            $my_prefix = $prefix[array_rand($prefix)];
            $my_suffix = $suffix[array_rand($suffix)];
            $my_name = $my_prefix . $my_suffix;

        }while(in_array($my_name, $unavailable));

        $previous_array = explode(';', $previous);
        $previous_10_array = array_slice($previous_array, 0, 10);

        $previous = implode(', ', $previous_10_array);
        
        $_SESSION["previous"] = $my_name . ';' . implode(';', $previous_10_array);
        
        ?>
        <section>
        <h1><?php echo $my_name; ?></h1>
        <?php ?>

        <form method="POST" action="/week02/namegen/claim.php">
            <input type="hidden" value="<?php echo $my_name; ?>" name="my_name">
            <input type="submit" value="Claim deze naam">
        </form>
        </section>

    <footer>
        Previous: <?php echo $previous; ?>
    </footer>
    <?php 
    }
    ?>
    
</body>
</html>
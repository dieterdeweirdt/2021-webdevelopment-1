<?php

include_once 'data.php';

$prefix_length = count($prefix);
$suffix_length = count($suffix);

function generateName(){
    global $prefix_length, $suffix_length, $prefix, $suffix, $unavailable;

    $rp = rand(0, $prefix_length-1);
    $rs = rand(0, $suffix_length-1);

    $name = [$prefix[$rp], $suffix[$rs]];

    if(in_array(implode('', $name), $unavailable)) {
        $name = generateName();
    }

    return $name;

}

//Random layout
$random_font = $font[array_rand($font)];
$random_color = 'hsla(' . rand(0, 360) . ', ' . rand(55, 65) . '%, ' . rand(55, 65) . '%, 1)';

//Start session
session_start();

$previous = [];
//Get previous generated names from session and cast the string to array
if (isset($_SESSION['generatedNames'])) {
    $previous = (array) $_SESSION['generatedNames'];
}


if(isset($_POST["claim"]) && isset($_POST["name"])) {
    //Save to Database
    setcookie('my_name', $_POST['name'], time() + 3600);
    //$rec_id = claimProject($conn, $data);
    //redirect("thanks.php?student_id=" . $data['student_id']);
}
$my_name = '';
if ( isset($_COOKIE["my_name"]) ) {
    $my_name = $_COOKIE["my_name"];
}

//Generate new name
$name = generateName();
//Add new name to beginning of array
array_unshift($previous, $name);
//Slice first 11 elements from array and save in session
$_SESSION['generatedNames'] = array_slice($previous, 0, 11);


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
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
    <section>
        <?php if($my_name) : ?>
            <h2>You have claimed the name <?php echo $my_name; ?></h2>
        <?php else : ?>
            <h1><?php echo implode('', $name); ?></h1>
            <form method="post">
                <input type="hidden" name="name" value="<?php echo implode(',', $name); ?>">
                <input type="hidden" name="color" value="<?php echo $random_color; ?>">
                <input type="hidden" name="font" value="<?php echo $random_font; ?>">
                <button type="submit" name="claim" class="btn">Claim</button><br/><br/>
            </form>
        <?php endif; ?>
    </section>

    <footer>
        Previous:

        <?php 
        array_shift($previous);

        foreach($previous as $prev_name) {
            echo implode('', $prev_name) . ', ';
        }
        ?>
    </footer>
</body>
</html>
<?php
require_once 'config.php';

//create upload_dir if it doesn't exist
if(!is_dir(UPLOAD_PATH)){
    mkdir(UPLOAD_PATH);
}

if(isset($_FILES['my_file']) && $_FILES['my_file']['size'] > 0) 
{
    
    $file_name = $_FILES['my_file']["name"];
    $tmp_location = $_FILES['my_file']["tmp_name"];
    $new_location = UPLOAD_PATH . '/' . $file_name;
    $file_info = pathinfo($file_name);

    //Check on file extension use in_array 
    if( in_array($file_info['extension'], SAFE_EXTENSIONS)) {
        move_uploaded_file($tmp_location, $new_location);
        //redirect back
        header("Location: /darkshare");
        die();
    }
    else {
        $message = 'You may not upload this type of file!!!<br><img src="https://media.giphy.com/media/5ftsmLIqktHQA/giphy.gif">';
    }
    
}
else {
    $message = 'Oeps...';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DarkShare</title>
    <link rel="stylesheet" href="/week03/css/main.css">
</head>
<body>

<h1>DarkShare</h1>

<section>
<?php echo $message; ?>
</section>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>QR test</h1>
    <?php
    
    $autoload = __DIR__.'/vendor/autoload.php';

    var_dump(file_exists($autoload));
    require_once $autoload;

    use chillerlan\QRCode\{QRCode, QROptions};

    //require __DIR__ . '/vendor/chillerlan/php-qrcode/src/QRCode.php';

    $data = 'https://www.arteveldehogeschool.be';

    // quick and simple:
    echo '<img src="'.(new QRCode)->render($data).'" alt="QR Code" />';
    ?>
</body>
</html>
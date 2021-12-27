<?php

$autoload = __DIR__.'/vendor/autoload.php';

use Spatie\Image\Image;
   
$pathToImage = 'pexels.jpeg';
$pathToNewImage = 'pexels_gray.jpg';

// overwriting the original image with a greyscale version   
Image::load($pathToImage)
   ->greyscale()
   ->save($pathToNewImage);

   ?>

<img src='<?= $pathToNewImage; ?>'>
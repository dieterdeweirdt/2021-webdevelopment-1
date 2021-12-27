<?php 
$car_class = '';
if( $car->price > '7500') {
    if( $car->price > '10000') {
        $car_class = 'large';
    } else {
        $car_class = 'medium';
    }
} 
?>
<a href="detail.php?id=<?= $car->id; ?>" class="car <?= $car_class; ?>">
    <img src="https://loremflickr.com/500/500/car,<?= $car->make; ?>,<?= $car->color; ?>?<?=$key;?>">
    <div class="text">
        <h2><?= $car->make; ?> <?= $car->model; ?></h2>
        <div class="info">&euro; <?= $car->price; ?>,-</div>
    </div> 
    <i class="far fa-heart"></i>
</a>
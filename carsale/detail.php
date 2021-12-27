<?php 
require 'app.php';
$id = intval(isset($_GET['id']) ? $_GET['id'] : 0);

if(!$id) {
    header('location:index.php');
}

$car = Car::getCar($_GET['id']);
$is_fav =  Car::isFavorite($_GET['id'], 1);

include 'views/header.php'; 
?>
<header>
    <h1>CarSale</h1>
    <a href="index.php" class="btn btn-secondary">Back to search</a>
</header>
<div class="car-detail">
        <img src="https://loremflickr.com/1000/800/car,<?= $car->make; ?>">

        <h1><?= $car->make; ?> <?= $car->model; ?></h1>
        <div class="text"><dl>
            <dt>Color</dt>
            <dd><?= $car->color; ?></dd>
            <dt>Published</dt>
            <dd><?= $car->getDateInteval(); ?></dd>
            <dt>Seller</dt>
            <dd><?= $car->firstname; ?> <?= $car->lastname; ?></dd>
        </dl>
        <?php if ($is_fav) : ?>
            <a href="change_fav.php?car_id=<?= $car->id; ?>&remove=true" class="btn btn-secondary"><i class="fas fa-heart"></i> Remove from favorites</a>
        <?php else : ?>
            <a href="change_fav.php?car_id=<?= $car->id; ?>" class="btn btn-secondary"><i class="fal fa-heart"></i> Add to favorites</a>
        <?php endif; ?>
    </div>
    <div class="price">&euro; <?= $car->price; ?>,-</div>

</div>
<?php 
include 'views/footer.php'; 
?>
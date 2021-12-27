<?php 
require 'app.php';
$makes = Make::getMakesByCount();
$colors = Car::getColors();
$where = [];
if(isset($_COOKIE['filter']) ) {
    $where = unserialize($_COOKIE['filter']);
}
if(isset($_GET['filter'])) {
    $where['colors'] = (isset($_GET['color'])) ? $_GET['color'] : [];
    $where['makes'] = (isset($_GET['make'])) ? $_GET['make'] : [];
}
setcookie('filter', serialize($where));
$cars = Car::getBySearch($where);

include 'views/header.php'; 
?>
    <header>
        <h1>CarSale</h1>
        <form>
            <div class="form-group-title">Make</div>
            <?php include 'views/make_checkbox.php'; ?>
            <div class="form-group-title">Color</div>
            <?php include 'views/color_checkbox.php'; ?>
            <button class="btn btn-primary" type="submit" name="filter" value="true">Search</button>
        </form>
    </header>
    <div class="cars">
        <?php foreach($cars as $key => $car) {
            $car = (object) $car;
            include 'views/car_item.php';
        } ?>
        <!--<a href="add.html" class="car add"><i>+</i><span>Add car</span></a>-->
    </div>
<?php 
include 'views/footer.php'; 
?>
<?php
$search = $_GET['search'] ?? ''; ?>
<form method="GET" action="/">
    <input type="search" name="search" value="<?= $search; ?>" placeholder="zoekterm">
    <button type="submit" name="doSearch">Zoek</button>
</form>

<div class="products">
    <?php
    foreach($products as $product){
        include 'views/products/_partial/product.php';
    } ?>
</div>

<?php if($total_pages  > 1) {
    for($i = 1; $i <= $total_pages; $i++) {
        echo '<a href="/?search=' . $search . '&page=' . $i . '">' . $i . '</a> ';
    }
}
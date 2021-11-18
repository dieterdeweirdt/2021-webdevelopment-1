<?php
require_once '../../app.php';

//Get product_id
$product_id = 0;
if(isset( $_GET['product_id'] )){
    $product_id = $_GET['product_id'];
}

$product = Product::byId($product_id);
var_dump($product);

//Get Brands 
$sql = 'SELECT * FROM brand ORDER BY name';
$brands = $db->query($sql)->fetchAll();


//CHECK IF FORM IS POST
if(isset($_POST['submit_btn']))
{
    //GET VALUES FROM POST
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand_id = $_POST['brand_id'];

    //TODO: Image upload && save filename in table product

    //check product_id, indien bestaat: update anders insert
    if($product_id) {
        //UPDATE SQL STATEMENT
        $sql = 'UPDATE product 
                SET name=:name, description=:description, price=:price, brand_id=:brand_id
                WHERE product_id=:product_id';

        //prepare and execute
        $sth = $db->prepare($sql);
        $sth->execute([
            ':product_id' => $product_id,
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':brand_id' => $brand_id
        ]);
    } else {
        //UPDATE SQL STATEMENT
        $sql = 'INSERT INTO product (name, description, price, brand_id) 
                VALUES  (:name, :description, :price, :brand_id)';

        //prepare and execute
        $sth = $db->prepare($sql);
        $sth->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':brand_id' => $brand_id
        ]);

        // Haal id op van toegevoegd item
        $product_id = $db->lastInsertId();
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product - <?php echo SITE_NAME; ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/main.css">
</head>
<body>
<nav class="primary darken-2">
    <div class="nav-wrapper">
      <a href="<?php echo ADMIN_URL; ?>" class="brand-logo"><?php echo SITE_NAME; ?></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sass.html"><i class="material-icons">search</i></a></li>
        <li><a href="badges.html"><i class="material-icons">view_module</i></a></li>
        <li><a href="collapsible.html"><i class="material-icons">refresh</i></a></li>
        <li><a href="mobile.html"><i class="material-icons">more_vert</i></a></li>
      </ul>
    </div>
  </nav>
<div class="row">
    <div class="col s2">
        <div class="collection">
            <a href="#!" class="collection-item">Pages</a>
            <a href="<?php echo ADMIN_URL; ?>products" class="collection-item active">Products</a>
            <a href="#!" class="collection-item">Comments</a>
            <a href="#!" class="collection-item">Admins</a>
          </div>
                 
    </div>
    <div class="col s10">
        <pre>
        <?php
            //check product_id
            $product = null;
            if($product_id) {
                $product = get_product_by_id($product_id);
            }
        ?>
        </pre>
        <h2><?php echo ($product_id) ? 'Edit' : 'Add'; ?> product</h2>
        <form method="POST">
            <div class="input-field">
                <input placeholder="" id="name" name="name" value="<?php if($product) { echo $product->name; } ?>" type="text" class="validate">
                <label for="name">Name</label>
            </div>
            <div class="input-field">
                <select id="brand" name="brand_id">
                    <option value="">Select brand...</option>
                    <?php foreach($brands as $brand) : ?>
                        <?php 
                            $selected = '';
                            if($product && $brand['brand_id'] == $product->brand_id) {
                                $selected = 'selected';
                            }
                        ?>
                        <option value="<?php echo $brand['brand_id']; ?>" <?php echo $selected; ?>>
                            <?php echo $brand['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="brand">Brand</label>
            </div>
            <div class="input-field">
                <input placeholder="" id="description" name="description" value="<?php if($product) { echo $product->description; } ?>" type="text" class="validate">
                <label for="description">Description</label>
            </div>
            <div class="input-field">
                <input placeholder="" id="price" name="price" value="<?php if($product) { echo $product->price; } ?>" type="text" class="validate">
                <label for="price">Price</label>
            </div>
            <div class="input-field">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="image">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload an image">
                    </div>
                </div>
            </div>
            <button type="submit" name="submit_btn" class="btn">Aanpassen</button>
        
            <a href="<?php echo ADMIN_URL ?>products/delete.php?product_id=<?php echo $product_id; ?>" class="waves-effect waves-light btn delete red right">delete</a>

        </form>
    </div>


    <!--LOAD SCRIPTS-->
    <script src="<?php echo SITE_URL; ?>node_modules/materialize-css/dist/js/materialize.min.js"></script>
    <script>
     document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, '');
    });
  </script>
</div>
</body>
</html>
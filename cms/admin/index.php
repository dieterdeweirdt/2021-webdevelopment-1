<?php
require_once '../app.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - <?php echo SITE_NAME; ?></title>
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
            <a href="<?php echo ADMIN_URL; ?>products" class="collection-item">Products</a>
            <a href="#!" class="collection-item">Comments</a>
            <a href="#!" class="collection-item">Admins</a>
          </div>
                 
    </div>
    <div class="col s10">
        Welkom op de admin
    </div>

</div>
</body>
</html>
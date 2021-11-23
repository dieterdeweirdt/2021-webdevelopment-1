<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default title' ?></title>
    <link rel="stylesheet" href="/css/main.css?v=<?= time(); ?>">
</head>
<body>
    <div class="wrapper">
        <a href="/" class="brand">FoodShop</a>

        <main>
            <?= $content; ?>
        </main>
        
        <?php include_once BASE_DIR . '/views/_templates/_partials/footer.php'; ?>
    </div>
</body>
</html>
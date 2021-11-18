<?php
    $view = 'list';
    if(isset($_COOKIE['view'])) {
        $view = $_COOKIE['view'];
    }
    if(isset($_GET['view'])) {
        $view = $_GET['view'];
        setcookie('view', $view, time() + 3600);
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DarkShare</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<h1>DarkShare</h1>

<section>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
        <input type="file" name="my_file" class="input"> 
        <input type="submit" value="Share" class="btn">
    </form>
</section>
<section>
    <h2>Shared files</h2>
    
    <div class="filter">
        <form>
            <input type="text" name="q">
            <input type="submit" value="Search" class="btn">
        </form>
        <div class="view_switch">
            <a href="?view=list">list</a>
            <a href="?view=grid">grid</a>
        </div>
    </div>
    <div class="file-list <?php echo $view; ?>">
    <?php 
        require_once 'config.php'; //variabelen inladen zoals UPLOAD_PATH, SAFE_EXTENSIONS, ...
        require_once 'functions.php'; //inladen van eigen functies: file_is_image en human_filesize
        
        if(is_dir(UPLOAD_PATH)) 
        {
            //lees alle items in van een directory.
            $items = scandir(UPLOAD_PATH, 1);

            if(is_array($items)) //double check if items is an array and not empty
            {
                //overloop al deze items
                foreach($items as $item)
                {
                    $item_path = UPLOAD_PATH . '/' . $item;
                    //enkel indien het een bestand is deze in de lijst plaatsen
                    if( is_file($item_path) )
                    {
                        $file_name = $item;
                        $file_size = filesize($item_path);
                        $file_info = pathinfo($item_path); //pathinfo splits een URI op in folder, filename en extention
                        $file_extension = $file_info['extension'];

                        ?>
                            <div class="file">
                                <?php if( file_is_image($file_extension) ) : ?>
                                    <div class="icon icon-image">
                                        <img src="/darkshare/<?php echo $item_path; ?>">
                                    </div>
                                <?php else : ?>
                                    <div class="icon icon-<?php echo $file_extension; ?>">
                                        <span>
                                            <?php echo $file_extension; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <div class="file_info">   
                                    <strong><?php echo $file_name; ?></strong><br>
                                    <?php echo human_filesize($file_size); ?>
                                </div>
                                <div class="buttons">
                                <?php if( file_is_text($file_extension) ) : ?>
                                    <a href="/darkshare/edit.php?file=<?php echo $item_path; ?>" class="btn">Edit</a>
                                <?php endif; ?>
                                    <a href="/darkshare/<?php echo $item_path; ?>" class="btn" download>Download</a>
                                </div>
                            </div> 
                        <?php
                    }
                }
            }
        }
        else {
            echo 'Upload folder bestaat niet en zal pas aangemaakt worden bij het opladen van het eerste bestand...';
        }
    ?>
    </div>

    <div class="paging">
        <a href="?page=1" class="current">1</a>
        <a href="?page=2">2</a>
        <a href="?page=3">3</a>
        <a href="?page=4">4</a>
        <a href="?page=5">5</a>
    </div>
</section>

</body>
</html>
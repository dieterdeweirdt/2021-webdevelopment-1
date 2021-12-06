<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $url = 'http://data.stad.gent/explore/dataset/real-time-bezettingen-fietsenstallingen-gent/download/?format=json&timezone=Europe/Brussels&lang=en';

        $content_api = file_get_contents($url);

        $content_json = json_decode($content_api);

        //print_r($content_api);
        //print_r($content_json);

        foreach($content_json as $item) {
            echo '<br>' . $item->fields->facilityname . ': ' . $item->fields->freeplaces;
        }
    ?>
</body>
</html>
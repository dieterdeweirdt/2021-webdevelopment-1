<?php

class PageController {

    protected function loadView($view, $params = []) {
        extract($params);

        ob_start();
        include 'views/' . $view . '.php';
        $content = ob_get_contents();
        ob_end_clean();

        include 'views/_templates/main.php';

    }

}
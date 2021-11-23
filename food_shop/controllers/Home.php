<?php

class HomeController extends BaseController {

    protected function index () {
        $total = Product::getCount();
        $page_size = 21;
        $total_pages = ceil($total/$page_size);

        $page = $_GET['page'] ?? 1;


        $this->viewParams['products'] = Product::getAll($page_size, $page);
        
        $this->viewParams['current_page'] = $page;
        $this->viewParams['total_pages'] = $total_pages;

        $this->loadView();
    }

    
}
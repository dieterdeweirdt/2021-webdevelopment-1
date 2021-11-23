<?php

class ProductsController extends BaseController {

    protected function index ($page = 1) {



        $this->viewParams['products'] = Product::getAll($page);
        $total = Product::getCount();
        $page_size = 21;
        $total_pages = ceil($total/$page_size);

        $this->viewParams['current_page'] = $page;
        $this->viewParams['total_pages'] = $total_pages;


        $this->loadView();
    }

    protected function detail ($id) {
        $product = Product::getById($id);

        if(isset($_POST['submit_order'])){
            $amount = $_POST['amount'] ?? 1;
            $first_name = $_POST['first_name'] ?? '';
            $last_name = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';

            $order_id = Product::placeOrder($id, $amount, $first_name, $last_name, $email, $product->unit_price);
            $this->viewParams['order_id'] = $order_id;
        }
        $this->viewParams['product'] = $product;

        
        $this->loadView();
    }

}
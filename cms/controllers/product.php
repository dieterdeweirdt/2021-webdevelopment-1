<?php

if( ! function_exists('get_products')) {
    function get_products($filter = []){
        global $db;

        $where = '1=1';
        $params = [];
        if(isset($filter['name'])){
            $where .= ' AND product.name LIKE :name';
            $params[':name'] = '%' . $filter['name'] . '%';
        }

        if(isset($filter['brand_name'])){
            $where .= ' AND brand.name LIKE :brand_name';
            $params[':brand_name'] = '%' . $filter['brand_name'] . '%';
        }



        $sql = 'SELECT product.*, brand.name as brand FROM product 
                LEFT JOIN brand ON brand.brand_id = product.brand_id
                WHERE ' . $where . '
                ORDER BY product.name';

        $sth = $db->prepare($sql);
        $sth->execute($params);
        $result = $sth->fetchAll();


        return $result;
    }
}

if( ! function_exists('get_product_by_id')) {
    function get_product_by_id($product_id){
        global $db;        

        $sql = 'SELECT * FROM product WHERE product_id = :product_id';

        $sth = $db->prepare($sql);
        $sth->execute([':product_id' => $product_id]);
        $result = $sth->fetchObject();
        
        return $result;
    }
}
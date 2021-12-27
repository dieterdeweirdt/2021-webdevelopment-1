<?php

class Make extends BaseModel {
    

    public function __construct() {
        $this->table = 'makes';
    }

    public static function getMakesByCount () {
        global $db;

        $sql = 'SELECT makes.id, name, count(c.id) as total
                FROM `makes` 
                INNER JOIN `cars` c ON c.make_id = makes.id
                GROUP BY makes.id
                ORDER BY total DESC';
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute();

        $db_items = $pdo_statement->fetchAll(); 
        
        
        return $db_items;
    }


}
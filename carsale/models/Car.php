<?php

class Car extends  BaseModel  {
    

    public function __construct() {
        $this->table = 'cars';
    }

    protected static function getBySearch($params = []) {
        global $db;

        $where = [];
        $exec_params = [];
        $where[] = 'TRUE'; // voeg 1 vergelijking toe die altijd waar is bv TRUE of 1=1, zodanig dat indien er geen zoekopdracht is er sowieso 'where TRUE' in de query staat
        if(isset($params['colors']) && count($params['colors'])) {
            //maak een array met vraagtekens volgens de langte van de colors parameter en voeg deze samen met een komma tussen
            $question_marks = implode(',  ', array_fill(0, count($params['colors']), '?'));
            $where[] = 'color IN (' . $question_marks . ') ';
            $exec_params = array_merge($exec_params, $params['colors']);
        }
        if(isset($params['makes']) && count($params['makes'])) {
            $question_marks = implode(',  ', array_fill(0, count($params['makes']), '?'));
            $where[] = 'make_id IN (' . $question_marks . ') ';
            $exec_params = array_merge($exec_params, $params['makes']);
        }

        $sql = 'SELECT `cars`.*, `makes`.`name` as make
                FROM `cars`
                INNER JOIN `makes` ON `makes`.`id` = `cars`.`make_id`
                WHERE ' . implode(' AND ', $where); // voeg alle where statements toe met tussen in een ' AND '

        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute($exec_params);

        $db_items = $pdo_statement->fetchAll(); 

        $items = [] ;

        foreach($db_items as $db_item) {
            $items[] = (new static)->castDbObjectToModel($db_item);
        }
        
        return $items;
    }

    protected static function getColors () {
        global $db;

        $sql = 'SELECT color, count(id) as total
                FROM `cars` 
                GROUP BY color
                ORDER BY total DESC';
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute();

        $db_items = $pdo_statement->fetchAll(); 
        
        
        return $db_items;
    }


    protected static function getCar ( $id ) {
        global $db;

        $sql = 'SELECT `cars`.*, `makes`.`name` as make, `users`.`firstname`, `users`.`lastname`
        FROM `cars`
        INNER JOIN `makes` ON `makes`.`id` = `cars`.`make_id`
        INNER JOIN `users` ON `users`.`id` = `cars`.`seller_id`
        WHERE `cars`.id  =  ?';

        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([  $id ]);

        $db_object = $pdo_statement->fetchObject(); 
        
        return (new static)->castDbObjectToModel($db_object);
    }

    protected static function addToFavorites ( $car_id, $user_id ) {
        global $db;

        $sql = 'INSERT INTO `favorites` (`car_id`, `user_id`) VALUES ( ?, ?)';

        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([ $car_id, $user_id ]);

        return $db->lastInsertId();
        
    }

    protected static function removeFromFavorites ( $car_id, $user_id ) {
        global $db;

        $sql = 'DELETE FROM `favorites` WHERE `car_id` = ? AND `user_id` = ?';

        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([ $car_id , $user_id ]);

        return $db->lastInsertId();
        
    }

    protected static function isFavorite ( $car_id, $user_id ) {
        global $db;

        $sql = 'SELECT * FROM favorites WHERE `car_id` = ? AND `user_id` = ? ';

        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([  $car_id, $user_id ]);

        $db_items = $pdo_statement->fetchObject(); 

        
        return isset($db_items->user_id);
    }
    
    public function getDateInteval($format = '%a days ago') {
        $created = new DateTime($this->created_on);
        $now = new DateTime();
        $interval = $created->diff($now);
        return $interval->format($format);
    }
}
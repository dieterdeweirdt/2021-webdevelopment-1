<?php

class BaseModel {

    protected $table;
    protected $pk;

    public static function __callStatic ($method, $arg) {
        $obj = new static;
        $result = call_user_func_array (array ($obj, $method), $arg);
        if (method_exists ($obj, $method))
            return $result;
        return $obj;
    }

    private function getAll($page_size = 0, $current_page = 1 ) {
        global $db;
        $params = [];


        $sql = 'SELECT * FROM `' . $this->table . '`';

        if(isset($_GET['search'])) {
            $sql .= ' WHERE name LIKE :search';
        }

        if($page_size > 0) {
            $sql .= ' LIMIT :offset, :page_size';
        }



        $pdo_statement = $db->prepare($sql);
        
        if($page_size > 0) {
            $pdo_statement->bindValue(':offset', $page_size*($current_page-1), PDO::PARAM_INT);  
            $pdo_statement->bindValue(':page_size', $page_size, PDO::PARAM_INT);  
        }

        if(isset($_GET['search'])) {
            $pdo_statement->bindValue(':search', '%' . $_GET['search'] . '%');  
        }

        $pdo_statement->execute();

        $db_items = $pdo_statement->fetchAll(); 
        $items = [] ;

        foreach($db_items as $db_item) {
            $items[] = $this->castDbObjectToModel($db_item);
        }

        return $items;
    }

    private function getCount() {
        global $db;

        $sql = 'SELECT count(*) FROM `' . $this->table . '`';

        if(isset($_GET['search'])) {
            $sql .= ' WHERE name LIKE :search';
        }

        $pdo_statement = $db->prepare($sql);

        if(isset($_GET['search'])) {
            $pdo_statement->bindValue(':search', '%' . $_GET['search'] . '%');  
        }

        $pdo_statement->execute();

        $count = $pdo_statement->fetchColumn(); 
        
        return $count;
    }

    private function getById( int $id ) {
        global $db;

        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :p_id';
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute( [ ':p_id' => $id ] );

        $db_item = $pdo_statement->fetchObject();

        return $this->castDbObjectToModel($db_item);
    }

    protected function castDbObjectToModel ($db_item) {

        $db_item = (object) $db_item;
        //Creates new Model
        $model_name = get_class($this);
        $item = new $model_name();
        //Loops through the db columns and 
        
        foreach($db_item as $column => $value) {
            $item->{$column} = $value;
        } 
        return $item;
    }

    //static method to call like: Model::deleteById(1);
    private function deleteById( int $id ) {
        global $db;

        $sql = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->pk . '` = :p_id';
        $pdo_statement = $db->prepare($sql);
        return $pdo_statement->execute( [ ':p_id' => $id ] );
    }

    //public method to call like: $my_model->delete();
    public function delete () {
        $this->deleteById( $this->{$pk} );
    }
}
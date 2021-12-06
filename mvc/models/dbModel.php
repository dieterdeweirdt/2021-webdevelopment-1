<?php

class dbModel {
    protected $table;
    protected $pk;

    public static function __callStatic ($method, $arg) {
        $obj = new static;
        $result = call_user_func_array (array ($obj, $method), $arg);
        if (method_exists ($obj, $method))
            return $result;
        return $obj;
    }

    private function getAll() {
        global $db;

        $stmnt = $db->prepare('SELECT * FROM `' . $this->table . '`'); 
        if($stmnt) {
            $success = $stmnt->execute();

            if($success) {
                $result = $stmnt->fetchAll();
                return $result;
            }
        } 

    }

    private function getById($id) {
        global $db;
        
        $stmnt = $db->prepare('SELECT * FROM `' . $this->table . '` WHERE ' . $this->pk . ' = ?'); 
        if($stmnt) {
            $success = $stmnt->execute( [ $id ] );

            if($success) {
                $result = $stmnt->fetchObject();

                foreach($result as $property => $value) {
                    $this->$property = $value;
                }

            }
        } 
        return $this;
    }

    private function update($fields = []) {
        //TODO update with the $_POST values

        echo 'Dit is de update van dbModel';

        print_r($fields);
    }
}
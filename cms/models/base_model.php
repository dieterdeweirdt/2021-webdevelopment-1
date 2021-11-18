<?php

class Base_Model {

    protected $table = '';
    protected $primaryKey = 'id';

    public function __construct($data = null)
    {
        if (empty ($this->table))
            $this->table = get_class ($this);

        if ($data)
            $this->data = $data;
    }

    public function __call ($method, $arg) {
        
        if (method_exists ($this, $method))
            return call_user_func_array (array ($this, $method), $arg);

        call_user_func_array (array ($this->db, $method), $arg);
        return $this;
    }

    public static function __callStatic ($method, $arg) {
        $obj = new static;
        $result = call_user_func_array (array ($obj, $method), $arg);
        if (method_exists ($obj, $method))
            return $result;
        return $obj;
    }

    public function all() {

        global $db;
    
        $sql = 'SELECT * FROM ' . $this->table;

        $sth = $db->prepare($sql);
        $sth->execute([]);
        $result = $sth->fetchAll();

        return $result;

    }

    private function byId($id) {

        global $db;
    
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id';

        $sth = $db->prepare($sql);
        $sth->execute([':id' => $id]);
        $result = $sth->fetchObject();

        return new static ( $result );

    }
}
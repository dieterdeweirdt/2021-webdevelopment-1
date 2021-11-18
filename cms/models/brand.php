<?php


class Brand extends Base_Model {

    protected $table = 'brand';
    protected $primaryKey = 'brand_id';

    public $name;
    public $description;

    public function __construct() {

        $this->name = 'Nike';
        $this->description = 'Omschrijving van Nike';

        print 'De class ' . 
                get_class ($this) . 
                ' is aangemaakt ';
    }

    public function byId($id){
        global $db;

        $sql = 'SELECT * FROM brand WHERE brand_id = :brand_id';

        $sth = $db->prepare($sql);
        $sth->execute([':brand_id' => $id]);
        $result = $sth->fetchObject();

        $this->name = $result->name;
        $this->description = $result->description;
        
    }

}
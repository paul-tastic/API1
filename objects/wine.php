<?php

class Wine
{
 
    private $connection;
    private $table_name = "wines";
 
    public $id;
    public $name;
    public $vineyard;
    public $vintage;
    public $varietal;
    public $modified;

    public function __construct($db) {
        $this->connection = $db;
    }

    function read() {
        $query = "SELECT *
                    FROM {$this->table_name}
                    ORDER BY modified DESC";
     
        $stmt = $this->connection->prepare($query);     
        $stmt->execute();
     
        return $stmt;
    }

}
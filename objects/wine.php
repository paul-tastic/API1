<?php

class Wine
{
 
    // database connection and table name
    private $connection;
    private $table_name = "wines";
 
    // object properties
    public $id;
    public $name;
    public $vineyard;
    public $vintage;
    public $varietal;
    public $created;

    public function __construct($db) {
        $this->connection = $db;
    }


    function read() {
        $query = "SELECT
                    `NAME` as 'wine name', 
                    `VINEYARD` AS 'Vineyard'
                    `VINTAGE` AS 'Vintage'
                    ID, 
                    `CREATED` AS 'Date Created'
                FROM {$this->table_name}
                ORDER BY CREATED DESC";
     
        $stmt = $this->connection->prepare($query);     
        $stmt->execute();
     
        return $stmt;
    }

}
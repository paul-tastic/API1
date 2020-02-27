<?php

class Product
{
 
    // database connection and table name
    private $connection;
    private $table_name = "PRODUCTS";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db) {
        $this->connection = $db;
    }


    function create() {
     
        $query = "INSERT INTO {$this->table_name} 
                SET
                    name=:name, price=:price, description=:description, category_id=:category_id, created=:created";
     
        $stmt = $this->conn->prepare($query);
     
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->created=htmlspecialchars(strip_tags($this->created));
     
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->created);
     
        if($stmt->execute()){
            return true;
        }
        return false;
         
    }

    function read() {
        $query = "SELECT
                    C.NAME as category_name, 
                    P.ID, 
                    P.NAME, P.DESCRIPTION, P.PRICE, P.CATEGORY_ID, P.CREATED
                FROM {$this->table_name} AS P
                LEFT JOIN CATEGORIES C ON P.CATEGORY_ID = C.ID
                ORDER BY P.CREATED DESC";
     
        $stmt = $this->conn->prepare($query);     
        $stmt->execute();
     
        return $stmt;
    }


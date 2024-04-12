<?php

 //fetching data


class Connection {
    public $connection;
    private $host = "localhost";
    private $db = "resort-db";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8mb4";
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //fetch data
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    public function __construct(){ //to initialize connection to database
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        
        $this->connection =  new PDO ($dsn, $this->user, $this->pass, $this->options);
    }

    public function ready($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;
      }
}
?>
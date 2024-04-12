<?php

require_once "./db.php";
require_once "./json.php";

class FunctionHall { //to pretify the data in JSON format
    public $hall_type;
    public $hall_image;
    public $hall_description;
    public $hall_capacity;
    public $hall_price;
}

$dbname = new Connection(); //set up new connection from database
$method = $_SERVER["REQUEST_METHOD"]; //to access _GET (Url access) and _POST (To add another record)

if ($method === "GET"){
    $query = "SELECT * FROM functionhall_types";
    if (isset($_GET["hallType_id"])){ // isset to weither the variable is set or not
        $query .= " WHERE hallType_id = :hallType_id";
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute([
            "hallType_id" => $_GET["hallType_id"]
        ]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "FunctionHall");
        $data = $stmt->fetch();
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "FunctionHall");
        $data = $stmt->fetchAll();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}


?>
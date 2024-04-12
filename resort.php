<?php

require_once "./db.php";
require_once "./json.php";

class Resort { //to pretify the data in JSON format
    public $resort_id;
    public $resort_name;
    public $resort_description;
    public $resort_image;
    public $resort_tags;
    public $resort_streetAddress;
    public $resort_country;
    public $resort_postalCode;
    public $resort_phoneNumber;
    public $resort_email;
}

$dbname = new Connection(); //set up new connection from database
$method = $_SERVER["REQUEST_METHOD"]; //to access _GET (Url access) and _POST (To add another record)

if ($method === "GET"){
    $query = "SELECT * FROM resort";
    if (isset($_GET["resort_id"])){ // isset to weither the variable is set or not
        $query .= " WHERE resort_id = :resort_id";
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute([
            "resort_id" => $_GET["resort_id"]
        ]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Resort");
        $data = $stmt->fetch();
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Resort");
        $data = $stmt->fetchAll();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
} 

?>
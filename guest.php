<?php

require_once "./db.php";
require_once "./json.php";

class Guest { //to pretify the data in JSON format
    public $guest_id;
    public $guest_firstName;
    public $guest_lastName;
    public $guest_gender;
    public $guest_phoneNumber;
    public $guest_email;
    public $guest_address;
    public $guest_city;
    public $guest_country;
}

$dbname = new Connection(); //set up new connection from database
$method = $_SERVER["REQUEST_METHOD"]; //to access _GET (Url access) and _POST (To add another record)

if ($method === "GET"){
    $query = "SELECT * FROM guest";
    if (isset($_GET["guest_id"])){ // isset to weither the variable is set or not
        $query .= " WHERE guest_id = :guest_id";
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute([
            "guest_id" => $_GET["guest_id"]
        ]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Guest");
        $data = $stmt->fetch();
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Guest");
        $data = $stmt->fetchAll();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
} else if ($method === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $query = "INSERT INTO guest (guest_id, guest_firstName, guest_lastName, guest_gender, guest_phoneNumber, guest_email, guest_address, guest_city, guest_country)
    VALUES (:guest_id, :guest_firstName, :guest_lastName, :guest_gender, :guest_phoneNumber, :guest_email, :guest_address, :guest_city, :guest_country)";
    $stmt = $dbname->connection->prepare($query);
    $stmt->execute([
        "guest_id" => $_POST["guest_id"],
        "guest_firstName" => $_POST["guest_firstName"],
        "guest_lastName" => $_POST["guest_lastName"],
        "guest_gender" => $_POST["guest_gender"],
        "guest_phoneNumber" => $_POST["guest_phoneNumber"],
        "guest_email" => $_POST["guest_email"],
        "guest_address" => $_POST["guest_address"],
        "guest_city" => $_POST["guest_city"],
        "guest_country" => $_POST["guest_country"]
    ]);
    echo json_encode([
        "message" => "Data inserted"
      ], JSON_PRETTY_PRINT);
}








?>
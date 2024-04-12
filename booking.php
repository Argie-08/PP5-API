<?php

require_once "./db.php";
require_once "./json.php";

class Booking { //to pretify the data in JSON format
    public $booking_id;
    public $booking_time;
    public $checkIn_date;
    public $checkOut_date;
    public $guest_id;
    public $resort_id;
}

$dbname = new Connection(); //set up new connection from database
$method = $_SERVER["REQUEST_METHOD"]; //to access _GET (Url access) and _POST (To add another record)

if ($method === "GET"){
    $query = "SELECT * FROM booking";
    if (isset($_GET["booking_id"])){ // isset to weither the variable is set or not
        $query .= " WHERE booking_id = :booking_id";
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute([
            "booking_id" => $_GET["booking_id"]
        ]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Booking");
        $data = $stmt->fetch();
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Booking");
        $data = $stmt->fetchAll();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}

?>
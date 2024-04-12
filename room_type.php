<?php

require_once "./db.php";
require_once "./json.php";

class Room { //to pretify the data in JSON format
    public $roomType_id;
    public $room_name;
    public $room_img;
    public $room_price;
    public $room_type;
    public $room_capacity;
    public $room_description;
}

$dbname = new Connection(); //set up new connection from database
$method = $_SERVER["REQUEST_METHOD"]; //to access _GET (Url access) and _POST (To add another record)

if ($method === "GET"){
    $query = "SELECT * FROM room_type";
    if (isset($_GET["roomType_id"])){ // isset to weither the variable is set or not
        $query .= " WHERE roomType_id = :roomType_id";
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute([
            "roomType_id" => $_GET["roomType_id"]
        ]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Room");
        $data = $stmt->fetch();
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $stmt = $dbname->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Room");
        $data = $stmt->fetchAll();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

} else if ($method === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $query = "INSERT INTO room_type (roomType_id, room_name, room_img, room_price, room_type, room_capacity, room_description)
    VALUES (:roomType_id, :room_name, :room_img, :room_price, :room_type, :room_capacity, :room_description)";
    $stmt = $dbname->connection->prepare($query);
    $stmt->execute([
        "roomType_id" => $_POST["roomType_id"],
        "room_name" => $_POST["room_name"],
        "room_img" => $_POST["room_img"],
        "room_price" => $_POST["room_price"],
        "room_type" => $_POST["room_type"],
        "room_capacity" => $_POST["room_capacity"],
        "room_description" => $_POST["room_description"],
    ]);
    echo json_encode([
        "message" => "Created new room"
      ], JSON_PRETTY_PRINT);
} else if ($method === "PUT") {
    $_PUT = json_decode(file_get_contents('php://input'), true);
    $query = "UPDATE room_type SET room_name=:room_name, room_img=:room_img, room_price=:room_price, room_type =:room_type, room_capacity=:room_capacity, room_description=:room_description WHERE roomType_id =:roomType_id";
    $stmt = $dbname->connection->prepare($query);
    $stmt->execute([
        "room_name" => $_PUT["room_name"],
        "room_img" => $_PUT["room_img"],
        "room_price" => $_PUT["room_price"],
        "room_type" => $_PUT["room_type"],
        "room_capacity" => $_PUT["room_capacity"],
        "room_description" => $_PUT["room_description"],
        "roomType_id" => $_GET["roomType_id"],
    ]);
    echo json_encode([
        "message" => "Room Updated"
      ], JSON_PRETTY_PRINT);
}   else if ($method === "DELETE") {
    $query = "DELETE from room_type WHERE roomType_id = :roomType_id";
    $stmt = $dbname->connection->prepare($query);
    $stmt->execute([
        "roomType_id" => $_GET["roomType_id"],
    ]);
    echo json_encode([
        "message" => "Room deleted"
      ], JSON_PRETTY_PRINT);
}


?>


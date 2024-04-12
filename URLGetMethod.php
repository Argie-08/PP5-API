<?php
//phpdelusions.net/pdo - basis of connecting to database
$host = "localhost";
$db = "resort-db"; //connect to database
$user = "root";
$pass = "";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //fetch data
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

$query = "SELECT * FROM guest
        WHERE guest_id = :guest_id";

$stmt = $pdo->prepare($query); // prepare use to prevent sql injection
$stmt->execute([
    "guest_id" => $_GET["guest_id"], // using _GET to have URL control
]);

$data = $stmt->fetchAll(); 

foreach ($data as $guest){
 echo $guest["guest_lastName"];
 echo "<br>";
}

?>
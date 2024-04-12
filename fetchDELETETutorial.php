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

//DEKETE data of guest

$guest_id = 1; //id where you want to delete

$query = "
    DELETE from guest
    WHERE guest_id = :guest_id 
";  //important WHERE clause to update specific key


$stmt = $pdo->prepare($query); // prepare use to prevent sql injection
$stmt->execute([
    "guest_id" => $guest_id,

]);

echo "Data DELETED" // will show to prove that data successfully inserted


?>
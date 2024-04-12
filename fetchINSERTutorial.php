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

//insert new data of guest

$guest_firstName = "Charmaine";
$guest_lastName = "Wong";
$guest_gender = "female";
$guest_phoneNumber = "0123456789";
$guest_email = "charmwong@gmail.com";
$guest_address = "Antonino";
$guest_city = "Labason";
$guest_country = "Philippines";

$query = "
    INSERT INTO guest (guest_firstName, guest_lastName, guest_gender, guest_phoneNumber, guest_email, guest_address, guest_city, guest_country) 
    VALUES (:guest_firstName, :guest_lastName, :guest_gender, :guest_phoneNumber, :guest_email, :guest_address, :guest_city, :guest_country)
"; 

//INSERT INTO - rowheader name where you want to insert your data
//VALUES - refer to rowheader where value will be inserted

$stmt = $pdo->prepare($query); // prepare use to prevent sql injection
$stmt->execute([
    "guest_firstName" => $guest_firstName,
    "guest_lastName" => $guest_lastName,
    "guest_gender" => $guest_gender,
    "guest_phoneNumber" => $guest_phoneNumber,
    "guest_email" => $guest_email,
    "guest_address" => $guest_address,
    "guest_city" => $guest_city,
    "guest_country" => $guest_country,
]);

echo "Data inserted" // will show to prove that data successfully inserted


?>
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

//fetch specific and singular data

$guest_gender = "male";

$query = "SELECT * FROM guest where guest_gender = :guest_gender";

$stmt = $pdo->prepare($query); // prepare use to prevent sql injection
$stmt->execute([
    "guest_gender" => $guest_gender
]);

$data = $stmt->fetchAll(); //fetchAll - to get multiple data, fetch - to get only one specific data

// while ($row = $stmt->fetch()) - alternative way
// {
//     echo $row['guest_firstName'] . "\n";
// }

foreach ($data as $guest){
 echo $guest["guest_gender"]."\n";
 echo "<br>"
}

?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cloudcrave_academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// $servername = "localhost";
// $username = "hbsngcom_usr";
// $password = "Miyaki007$";
// $dbname = "hbsngcom_acada";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// ?>

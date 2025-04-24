<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recenze_obedu";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Chyba pripojení: " . $conn->connect_error);
}
?>


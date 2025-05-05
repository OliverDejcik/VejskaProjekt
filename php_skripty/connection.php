<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recenze_obedu";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Chyba připojení: " . $conn->connect_error);
}
?>


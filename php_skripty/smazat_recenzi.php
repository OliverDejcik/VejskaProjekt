<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['recenze_id'])) {
    $recenze_id = $_POST['recenze_id'];
    $user_id = $_SESSION['user_id'];

    // Povolit mazání pouze vlastních recenzí
    $stmt = $conn->prepare("DELETE FROM recenze WHERE recenze_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $recenze_id, $user_id);

    if ($stmt->execute()) {
        header("Location: ../profil.php");
    } else {
        echo "Chyba při mazání recenze.";
    }

    $stmt->close();
} else {
    echo "Neplatný požadavek.";
}

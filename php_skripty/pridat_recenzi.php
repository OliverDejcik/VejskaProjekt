<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Musíš byť prihlásený.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $user_id = $_SESSION['user_id'];
    $obed_id = $_POST['obed_id'];
    $popis = trim($_POST['popis']);
    $hodnotenie = $_POST['hodnotenie'];

    if (strlen($popis) < 20 || $hodnotenie < 0 || $hodnotenie > 5) {
        echo "Neplatné údaje.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO recenze (user_id, obed_id, text_recenze, hodnoceni, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iisi", $user_id, $obed_id, $popis, $hodnotenie);

    if ($stmt->execute()) {
        echo "Recenze zaznamenána";
        
        header("Location: ../recenze_form.php?success=1");
        exit;
    } else {
        echo "Chyba pri ukladaní recenzie: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Neplatný prístup.";
}

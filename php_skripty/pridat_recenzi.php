<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../recenze_form.php?error=neprihlaseny");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $user_id = $_SESSION['user_id'];
    $obed_id = $_POST['obed_id'];
    $popis = trim($_POST['popis']);
    $hodnotenie = $_POST['hodnotenie'];

    if (strlen($popis) < 20 || $hodnotenie < 1 || $hodnotenie > 5) {
        header("Location: ../recenze_form.php?error=neplatne_udaje");
        exit;
    }

    // Kontrola, či už existuje recenzia pre tento obed od tohto používateľa
    $check_stmt = $conn->prepare("SELECT * FROM recenze WHERE user_id = ? AND obed_id = ?");
    $check_stmt->bind_param("ii", $user_id, $obed_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        header("Location: ../recenze_form.php?error=uz_si_hodnotil");
        exit;
    }
    $check_stmt->close();

    // Vloženie novej recenzie
    $stmt = $conn->prepare("INSERT INTO recenze (user_id, obed_id, text_recenze, hodnoceni, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iisi", $user_id, $obed_id, $popis, $hodnotenie);

    if ($stmt->execute()) {
        // Prepočet priemeru
        include 'vypocitat_priemer.php';
        aktualizujPriemerHodnotenia($obed_id, $conn);

        header("Location: ../recenze_form.php?success=1");
        exit;
    } else {
        $error_msg = urlencode("Databázová chyba: " . $stmt->error);
        header("Location: ../recenze_form.php?error=$error_msg");
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../recenze_form.php?error=neplatny_pristup");
    exit;
}

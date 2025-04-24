<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $osobni_cislo = $_POST['osobni_cislo'];
    $email = $_POST['email'];
    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    $heslo = $_POST['psw'];
    $heslo2 = $_POST['psw_2'];
    $role = $_POST['role'];

    if ($heslo !== $heslo2) {
        die("Hesla se neshodují.");
    }
    if ($role === "zak") {
        $role = "student";
    }

    // Hashovanie hesla
    $hashed_password = password_hash($heslo, PASSWORD_DEFAULT);

    // Avatar ako placeholder
    $avatar = '/avatars/default.jpg';

    // Vloženie do DB
    $stmt = $conn->prepare("INSERT INTO users (osobni_cislo, skolni_email, heslo, plain_password, avatar, jmeno, prijmeni, role, created_at, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), FALSE)");
    $stmt->bind_param("ssssssss", $osobni_cislo, $email, $hashed_password, $heslo, $avatar, $jmeno, $prijmeni, $role);

    if ($stmt->execute()) {
        header("Location: ./login.php");
    } else {
        echo "Registrace neúspěšná. <a href='register.php'>Opakovat registraci</a>";
    }

    $stmt->close();
    $conn->close();
}
?>

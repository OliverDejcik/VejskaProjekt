<?php
require_once 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $osobni_cislo = trim($_POST['uname']);
    $email = trim($_POST['email']);
    $jmeno = trim($_POST['jmeno']);
    $prijmeni = trim($_POST['prijmeni']);
    $heslo = $_POST['psw'];
    $heslo2 = $_POST['psw_2'];
    $role = $_POST['role'];

    if ($role === "zak") {
        $role = "student";
    }

    // Validácia hesla
    if (strlen($heslo) < 6 || preg_match('/\s/', $heslo)) {
        header("Location: register.php?error=Heslo musí mít alespoň 6 znaků a nesmí obsahovat mezery");
        exit();
    }

    if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $osobni_cislo)) {
        header("Location: register.php?error=Osobní číslo musí být ve formátu 3 velká písmena + 4 čísla (např. NOV0012)");
        exit();
    }
    

    if ($heslo !== $heslo2) {
        header("Location: register.php?error=Hesla se neshodují");
        exit();
    }

    // Hashovanie
    $hashed_password = password_hash($heslo, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (osobni_cislo, skolni_email, heslo, plain_password, avatar, jmeno, prijmeni, role, created_at, last_login, is_admin)
            VALUES (?, ?, ?, ?, '/avatars/default.jpg', ?, ?, ?, NOW(), NULL, FALSE)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $osobni_cislo, $email, $hashed_password, $heslo, $jmeno, $prijmeni, $role);

    if ($stmt->execute()) {
        header("Location: login.php?success=Registrace byla úspěšná");
        exit();
    } else {
        $error = urlencode("Chyba při registraci: " . $stmt->error);
        header("Location: register.php?error=$error");
        exit();
    }
}
?>
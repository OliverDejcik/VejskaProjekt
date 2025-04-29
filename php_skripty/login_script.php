<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST["login"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE osobni_cislo = ? OR skolni_email = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["heslo"])) {
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["jmeno"] = $user["jmeno"];
            $_SESSION["prijmeni"] = $user["prijmeni"];
            $_SESSION["is_admin"] = $user["is_admin"];
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../login.php?error=Nesprávné heslo");
            exit();
        }
    } else {
        header("Location: ../login.php?error=Uživatel nenalezen");
        exit();
    }
} else {
    header("Location: ../php_stranky/login.php");
    exit();
}

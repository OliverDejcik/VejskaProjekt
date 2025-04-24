<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'php_skripty/navbar.php'; ?>

    <div class="container">
        <h2>Přihlášení</h2>
        <?php if (isset($_GET["error"])): ?>
            <p class="error"><?= htmlspecialchars($_GET["error"]) ?></p>
        <?php endif; ?>
        <form method="POST" action="php_skripty/login_script.php">
            <input type="text" name="login" placeholder="Osobní číslo nebo školní email" required><br>
            <input type="password" name="password" placeholder="Heslo" required><br>
            <button type="submit">Přihlásit se</button>
        </form>
    </div>
</body>
</html>

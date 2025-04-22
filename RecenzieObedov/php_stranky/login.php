<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Seznam obědů</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include '../php_skripty/navbar.php'; ?>

    <div class="container">
        <label for="uname"><b>Zadejte osobní číslo:</b></label>
        <input type="text" placeholder="Osobní číslo" name="uname" required>

        <label for="psw"><b>Zadejte heslo:</b></label>
        <input type="password" placeholder="Heslo" name="psw" required>

        <button type="submit">Přihlásit se</button>
    </div>
</body>
</html>
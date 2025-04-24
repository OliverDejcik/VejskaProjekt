

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Registrace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'php_skripty/navbar.php'; ?>
    
    <form action="php_skripty/register_skript.php" method="post">
    <div class="container">
        <label for="uname"><b>Zadejte osobní číslo:</b></label>
        <input type="text" placeholder="Osobní číslo" name="osobni_cislo" required>

        <label for="email"><b>Zadejte e-mail:</b></label>
        <input type="email" placeholder="Email" name="email" required>

        <label for="jmeno"><b>Zadejte jméno:</b></label>
        <input type="text" placeholder="Jméno" name="jmeno" required>

        <label for="prijmeni"><b>Zadejte příjmení:</b></label>
        <input type="text" placeholder="Příjmení" name="prijmeni" required>

        <label for="psw"><b>Zadejte heslo:</b></label>
        <input type="password" placeholder="Heslo" name="psw" required>

        <label for="psw_2"><b>Zadejte heslo znovu:</b></label>
        <input type="password" placeholder="Heslo" name="psw_2" required>

        <label for="role"><b>Role:</b></label>
        <select name="role" id="role">
            <option value="zak">Žák</option>
            <option value="ucitel">Učitel</option>
            <option value="cizi">Nejsem učitelem ani žákem VŠB</option>
        </select>

        <button type="submit">Registrovat se</button>
    </div>
    </form>
</body>
</html>

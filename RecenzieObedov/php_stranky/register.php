

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Seznam obědů</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include '../php_skripty/navbar.php'; ?>
    
    <form action="action_page.php" method="post">
    <div class="container">
        <label for="uname"><b>Zadejte osobní číslo:</b></label>
        <input type="text" placeholder="Osobní číslo" name="uname" required>

        <label for="email"><b>Zadejte e-mail</b></label>
        <input type="text" placeholder="Email" name="email" required>

        <label for="jmeno"><b>Zadejte jmeno</b></label>
        <input type="text" placeholder="Jméno" name="jmeno" required>

        <label for="prijmeni"><b>Zadejte příjmení</b></label>
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
        </selec>

        <button type="submit">Přihlásit se</button>
    </div>
    </form>
</body>
</html>
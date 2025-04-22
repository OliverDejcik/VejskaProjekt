<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Recenze Obědů</title>
    <link rel="stylesheet" href="style.css">
    <!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Recenze Obědů</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'php_skripty/navbar.php'; ?>

    <div class="container">
        <h1>Vítejte na stránce Recenze Obědů</h1>
        <p>Naše platforma vám umožňuje recenzovat školní obědy a sdílet své názory s ostatními studenty.</p>
        <p>Najdete zde přehled hodnocení jednotlivých jídel, můžete přidávat vlastní recenze a hodnotit chutnost či kvalitu obědů.</p>
        <p>Také si můžete otevřít přehled jednotlivých jídelen (menz), které se účastní našeho systému.</p>

        <form action="connection.php" method="post">
            <button type="submit">Otestuj připojení k databázi</button>
        </form>
    </div>

</body>
</html>
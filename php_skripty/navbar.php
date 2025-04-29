<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["user_id"])) {
    // ak je uzivatel prihlaseny bude sa zobrazovat toto menu
    $pages = [
        "Hlavní stránka" => "index.php",
        "Seznam recenzí" => "prehled_recenzi.php",
        "Seznam obědů" => "prehled_obedu.php",
        "Seznam jídelen" => "prehled_jidelen.php",
        "Přidat recenzi" => "recenze_form.php",
    ];
} else {
    // ak je uzivatel odhlaseny bude sa zobrazovat toto menu
    $pages = [
        "Hlavní stránka" => "index.php",
        "Seznam recenzí" => "prehled_recenzi.php",
        "Seznam obědů" => "prehled_obedu.php",
        "Seznam jídelen" => "prehled_jidelen.php",
    ];
}

echo '<nav>';
foreach ($pages as $name => $url) {
    echo '<form method="get" action="' . $url . '" style="display:inline;">';
    echo '<button type="submit">' . $name . '</button>';
    echo '</form>';
}

if (isset($_SESSION["user_id"])) {
    echo '<span>';
    echo '<form method="post" action="php_skripty/logout.php" style="display:inline;">';
    echo '<button type="submit">Odhlášení</button>';
    echo '</form>';
    echo '</span>';
} else {
    echo '<span>';
    echo '<form method="get" action="login.php" style="display:inline;">';
    echo '<button type="submit">Přihlášení</button>';
    echo '</form>';
    echo '<form method="get" action="register.php" style="display:inline;">';
    echo '<button type="submit">Registrace</button>';
    echo '</form>';
    echo '</span>';
}

echo '</nav>';
?>
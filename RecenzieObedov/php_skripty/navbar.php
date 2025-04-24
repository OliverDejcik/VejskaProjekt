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
        "Odhlášení"=> "logout.php",
    ];
} else {
    // ak je uzivatel odhlaseny bude sa zobrazovat toto menu
    $pages = [
        "Hlavní stránka" => "index.php",
        "Přihlášení" => "login.php",
        "Registrace" => "register.php",
        "Seznam recenzí" => "prehled_recenzi.php",
        "Seznam obědů" => "prehled_obedu.php",
        "Seznam jídelen" => "prehled_jidelen.php",
    ];
}



echo '<nav>';
foreach ($pages as $name => $url) {
    echo "<a href=\"$url\">$name</a>";
}
echo '</nav>';
?>
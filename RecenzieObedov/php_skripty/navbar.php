<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["user_id"])) {
    // ak je uzivatel prihlaseny bude sa zobrazovat toto menu
    $pages = [
        "Hlavní stránka" => "http://localhost/VejskaProjekt/RecenzieObedov/",
        "Seznam recenzí" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/prehled_recenzi.php",
        "Seznam obědů" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/prehled_obedu.php",
        "Seznam jídelen" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/prehled_jidelen.php",
        "Odhlášení"=> "http://localhost/VejskaProjekt/RecenzieObedov/php_skripty/logout.php",
    ];
} else {
    // ak je uzivatel odhlaseny bude sa zobrazovat toto menu
    $pages = [
        "Hlavní stránka" => "http://localhost/VejskaProjekt/RecenzieObedov/",
        "Přihlášení" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/login.php",
        "Registrace" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/register.php",
        "Seznam recenzí" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/prehled_recenzi.php",
        "Seznam obědů" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/prehled_obedu.php",
        "Seznam jídelen" => "http://localhost/VejskaProjekt/RecenzieObedov/php_stranky/prehled_jidelen.php",
    ];
}



echo '<nav>';
foreach ($pages as $name => $url) {
    echo "<a href=\"$url\">$name</a>";
}
echo '</nav>';
?>
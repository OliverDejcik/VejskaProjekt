<?php
$pages = [
    "Přihlášení" => "#",
    "Registrace" => "#",
    "Přehled recenzí" => "#",
    "Seznam obědů" => "#",
    "Seznam jídelen" => "#"
];

echo '<nav>';
foreach ($pages as $name => $url) {
    echo "<a href=\"$url\">$name</a>";
}
echo '</nav>';
?>
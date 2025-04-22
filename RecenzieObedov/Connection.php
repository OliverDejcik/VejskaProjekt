<?php
// Nastavenie pripojenia k databáze
$host = 'recenze-obedu-petr77cz-c7ed.l.aivencloud.com';
$port = '19355';
$dbname = 'recenze-obedu';
$user = 'Webovka';
$password = 'W4ebwka111'; 

// DSN reťazec pre PostgreSQL
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";

try {
    // Vytvorenie PDO inštancie
    $pdo = new PDO($dsn, $user, $password);

    // Nastavenie režimu chýb
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Pripojenie k databáze bolo úspešné.<br><br>";

    // SQL dotaz
    $sql = "SELECT * FROM your_table"; // ← Zmeň na názov tvojej tabuľky
    $stmt = $pdo->query($sql);

    // Výpis výsledkov
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($rows);
    echo "</pre>";

} catch (PDOException $e) {
    echo "❌ Nepodarilo sa pripojiť k databáze: " . $e->getMessage();
}
?>
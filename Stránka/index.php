<?php
// Načítanie pripojenia k databáze
require_once 'Connection.php';

// Názov tabuľky
$tableName = 'your_table'; // ← nahraď reálnym názvom tabuľky

try {
    // SQL dotaz
    $stmt = $pdo->query("SELECT * FROM $tableName");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Chyba pri načítaní dát: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Výpis z databázy</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Dáta z tabuľky: <?php echo htmlspecialchars($tableName); ?></h2>
    <table>
        <thead>
            <tr>
                <?php if (!empty($rows)): ?>
                    <?php foreach (array_keys($rows[0]) as $column): ?>
                        <th><?php echo htmlspecialchars($column); ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <?php foreach ($row as $cell): ?>
                        <td><?php echo htmlspecialchars($cell); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
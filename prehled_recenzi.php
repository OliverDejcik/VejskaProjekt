<?php
session_start();
include 'php_skripty/connection.php';
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Prehľad obedov</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'php_skripty/navbar.php'; ?>

<h2>Zoznam obedov podľa hodnotenia</h2>

<ul class="obedy-list">
<?php
// Získanie obedov podľa priemerného hodnotenia
$sql = "
    SELECT o.obed_id, o.nazev_obedu, 
        ROUND(AVG(r.hodnoceni), 2) AS prumer_hodnoceni
    FROM obedy o
    LEFT JOIN recenze r ON o.obed_id = r.obed_id
    GROUP BY o.obed_id
    ORDER BY prumer_hodnoceni DESC
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $obed_id = $row['obed_id'];
        echo "<li>";
        echo "<strong>" . htmlspecialchars($row['nazev_obedu']) . "</strong><br>";
        echo "Priemerné hodnotenie: " . ($row['prumer_hodnoceni'] !== null ? $row['prumer_hodnoceni'] : "Žiadne hodnotenie") . "<br>";
        
        // Tlačidlo na zobrazenie recenzií
        echo '<form method="post">';
        echo '<input type="hidden" name="obed_id" value="' . $obed_id . '">';
        echo '<button type="submit" name="zobraz_recenze">Zobraziť recenzie k tomuto obedu</button>';
        echo '</form>';

        // Ak sa kliklo na tlačidlo pre tento obed, vypíšeme recenzie
        if (isset($_POST['zobraz_recenze']) && $_POST['obed_id'] == $obed_id) {
            $stmt = $conn->prepare("
                SELECT r.text_recenze, r.hodnoceni, r.created_at, u.osobni_cislo
                FROM recenze r
                JOIN users u ON r.user_id = u.user_id
                WHERE r.obed_id = ?
                ORDER BY r.created_at DESC
            ");
            $stmt->bind_param("i", $obed_id);
            $stmt->execute();
            $recenzie = $stmt->get_result();

            echo "<div class='recenzie'>";
            if ($recenzie->num_rows > 0) {
                echo "<ul>";
                while ($r = $recenzie->fetch_assoc()) {
                    echo "<li>";
                    echo "<strong>" . htmlspecialchars($r['osobni_cislo']) . "</strong> – ";
                    echo "<em>" . $r['hodnoceni'] . "/5</em><br>";
                    echo "<p>" . nl2br(htmlspecialchars($r['text_recenze'])) . "</p>";
                    echo "<small>Pridané: " . $r['created_at'] . "</small>";
                    echo "</li><hr>";
                }
                echo "</ul>";
            } else {
                echo "<p>Žiadne recenzie k tomuto obedu.</p>";
            }
            echo "</div>";

            $stmt->close();
        }

        echo "</li><hr>";
    }
} else {
    echo "<p>Žiadne obedy sa nenašli.</p>";
}

$conn->close();
?>
</ul>

</body>
</html>

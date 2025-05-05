<?php
session_start();
include 'php_skripty/connection.php';
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>PŘehled recenzí</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'php_skripty/navbar.php'; ?>



<!-- Vyhľadávací formulár -->
<div class="review-form">
<h2>Seznam obědů</h2>
<form method="post">
    <input type="text" name="search" placeholder="Vyhledej oběd..." value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
    <button class="Search" type="submit" name="search_btn">Vyhľadať</button>
</form>
</div>


<ul class="obedy-list">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_btn'])) {
    $search = trim($_POST['search']);
    $like = '%' . $search . '%';

    $stmt = $conn->prepare("
        SELECT obed_id, nazev_obedu, hodnoceni
        FROM obedy
        WHERE nazev_obedu LIKE ?
        ORDER BY hodnoceni DESC
    ");
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "
        SELECT obed_id, nazev_obedu, hodnoceni
        FROM obedy
        ORDER BY hodnoceni DESC
    ";
    $result = $conn->query($sql);
}

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $obed_id = $row['obed_id'];
        echo "<li>";
        echo "<strong>" . htmlspecialchars($row['nazev_obedu']) . "</strong><br>";
        echo "Průměrné hodnocení: " . ($row['hodnoceni'] !== null ? $row['hodnoceni'] : "Žiadne hodnotenie") . "<br>";
        
        // Tlačidlo na zobrazenie recenzií
        echo '<form method="post">';
        echo '<input type="hidden" name="obed_id" value="' . $obed_id . '">';
        echo '<button class="Search" type="submit" name="zobraz_recenze">Zobrazit recenze k tomuto obědu</button>';
        echo '</form>';

        // Zobrazenie recenzií
        if (isset($_POST['zobraz_recenze']) && $_POST['obed_id'] == $obed_id) {
            $stmtRec = $conn->prepare("
                SELECT r.text_recenze, r.hodnoceni, r.created_at, u.osobni_cislo
                FROM recenze r
                JOIN users u ON r.user_id = u.user_id
                WHERE r.obed_id = ?
                ORDER BY r.created_at DESC, r.recenze_id DESC
            ");
            $stmtRec->bind_param("i", $obed_id);
            $stmtRec->execute();
            $recenzie = $stmtRec->get_result();

            echo "<div class='recenzie'>";
            if ($recenzie->num_rows > 0) {
                echo "<ul>";
                while ($r = $recenzie->fetch_assoc()) {
                    echo "<li>";
                    echo "<strong>" . htmlspecialchars($r['osobni_cislo']) . "</strong> – ";
                    echo "<em> Hodnocení: " . $r['hodnoceni'] . " &#9733;</em><br>";
                    echo "<p>" . nl2br(htmlspecialchars($r['text_recenze'])) . "</p>";
                    echo "<small>Přidáno: " . $r['created_at'] . "</small>";
                    echo "</li><hr>";
                }
                echo "</ul>";
            } else {
                echo "<p>Zatím nejsou žádne recenze k tomuto obědu</p>";
            }
            echo "</div>";

            $stmtRec->close();
        }

        echo "</li><hr>";
    }
} else {
    echo "<p>Žádné obědy se nenašli</p>";
}

$conn->close();
?>
</ul>

</body>
</html>

<?php
session_start();
require_once 'php_skripty/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Načtení informací o uživateli
$stmt = $conn->prepare("SELECT skolni_email, jmeno, prijmeni, role FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Můj profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'php_skripty/navbar.php'; ?>

<div class="profile-container">
    <h2>Můj profil</h2>
    <p><strong>Jméno:</strong> <?= htmlspecialchars($user['jmeno']) . " " . htmlspecialchars($user['prijmeni']) ?></p>
    <p><strong>E-mail:</strong> <?= htmlspecialchars($user['skolni_email']) ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>

    <form method="post">
        <button class="Search" type="submit" name="zmenit_heslo">Změnit heslo</button>
        <button class="Search" type="submit" name="moje_recenze">Zobrazit moje recenze</button>
    </form>

    <?php
    if (isset($_POST['moje_recenze']) || isset($_POST['search_recenze'])) {
        $searchTerm = isset($_POST['search_text']) ? trim($_POST['search_text']) : '';

        echo "<h3>Moje recenze:</h3>";

        // Vyhľadávací formulár
        echo '<form method="post">';
        echo '<input type="text" name="search_text" placeholder="Vyhľadaj podľa názvu jedla..." value="' . htmlspecialchars($searchTerm) . '">';
        echo '<button class="Search" type="submit" name="search_recenze">Hľadať</button>';
        echo '<input type="hidden" name="moje_recenze" value="1">';
        echo '</form><br>';

        if (!empty($searchTerm)) {
            $like = '%' . $searchTerm . '%';
            $reviews_stmt = $conn->prepare("
                SELECT r.recenze_id, r.text_recenze, r.hodnoceni, r.created_at, o.nazev_obedu
                FROM recenze r
                JOIN obedy o ON r.obed_id = o.obed_id
                WHERE r.user_id = ? AND o.nazev_obedu LIKE ?
                ORDER BY r.created_at DESC
            ");
            $reviews_stmt->bind_param("is", $user_id, $like);
        } else {
            $reviews_stmt = $conn->prepare("
                SELECT r.recenze_id, r.text_recenze, r.hodnoceni, r.created_at, o.nazev_obedu
                FROM recenze r
                JOIN obedy o ON r.obed_id = o.obed_id
                WHERE r.user_id = ?
                ORDER BY r.created_at DESC
            ");
            $reviews_stmt->bind_param("i", $user_id);
        }

        $reviews_stmt->execute();
        $reviews_result = $reviews_stmt->get_result();

        if ($reviews_result->num_rows > 0) {
            echo "<ul>";
            while ($row = $reviews_result->fetch_assoc()) {
                echo "<li>";
                echo "<strong>" . htmlspecialchars($row['nazev_obedu']) . "</strong><br>";
                echo "Hodnocení: " . intval($row['hodnoceni']) . "/5<br>";
                echo "Recenze: " . nl2br(htmlspecialchars($row['text_recenze'])) . "<br>";
                echo "Datum: " . htmlspecialchars($row['created_at']) . "<br>";

                echo '<form method="post" action="php_skripty/smazat_recenzi.php" onsubmit="return confirm(\'Opravdu chcete smazat tuto recenzi?\')">';
                echo '<input type="hidden" name="recenze_id" value="' . $row['recenze_id'] . '">';
                echo '<button class="Remove" type="submit" name="smazat_recenzi">Smazat</button>';
                echo '</form>';

                echo "</li><hr>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nemáte žádné recenze.</p>";
        }

        $reviews_stmt->close();
    }
    ?>
</div>

</body>
</html>

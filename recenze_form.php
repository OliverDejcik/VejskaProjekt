<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<p>Musíš sa prihlásiť, aby si mohol pridávať recenzie.</p>";
    echo '<a href="login.php"><button>Prejsť na prihlásenie</button></a>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Pridať recenziu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'php_skripty/navbar.php'; ?>

<div class="review-form">
    <h2>Vyhľadaj obed</h2>
    <form action="recenze_form.php" method="post">
        <input type="text" name="search" placeholder="Zadaj názov obedu" required>
        <button type="submit" name="search_btn">Vyhľadať</button>
    </form>

    <?php
    include 'php_skripty/connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_btn'])) {
        $search = trim($_POST['search']);
        $stmt = $conn->prepare("SELECT * FROM obedy WHERE nazev_obedu LIKE ?");
        $like = "%$search%";
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $results = $stmt->get_result();

        if ($results->num_rows > 0) {
            echo '<h3>Výsledky hľadania:</h3><ul>';
            while ($row = $results->fetch_assoc()) {
                echo '<li>';
                echo '<strong>' . htmlspecialchars($row["nazev_obedu"]) . '</strong>';
                echo '<form action="php_skripty/pridat_recenzi.php" method="post">';
                echo '<input type="hidden" name="obed_id" value="' . $row["obed_id"] . '">';
                echo '<textarea name="popis" placeholder="Napíš recenziu..." minlength="20" required></textarea>';

                echo '<div class="rating">';
                for ($i = 0; $i <= 5; $i++) {
                    echo '<input type="radio" id="star' . $i . '_' . $row["obed_id"] . '" name="hodnotenie" value="' . $i . '" required>';
                    echo '<label for="star' . $i . '_' . $row["obed_id"] . '">' . $i . '</label>';
                }
                echo '</div>';

                echo '<button type="submit" name="submit_review">Odoslať recenziu</button>';
                echo '</form>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo "<p>Nenašli sa žiadne obedy s týmto názvom.</p>";
        }
    }
    ?>
</div>
</body>
</html>

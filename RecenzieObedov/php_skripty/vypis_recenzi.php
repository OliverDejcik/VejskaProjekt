

<?php
include 'connection.php';

$sql = "SELECT
            users.osobni_cislo,
            obedy.nazev_obedu,
            recenze.text_recenze,
            recenze.hodnoceni,
            recenze.created_at
        FROM recenze
        JOIN users ON recenze.user_id = users.user_id
        JOIN obedy ON recenze.obed_id = obedy.obed_id;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Název obědu</th><th>Osobní číslo uživatele</th><th>Text recenze</th><th>Hodnoceni</th><th>Čas hodnoceni</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nazev_obedu']}</td>
                <td>{$row['osobni_cislo']}</td>
                <td>{$row['text_recenze']}</td>
                <td>{$row['hodnoceni']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Žádné obědy nebyly nalezeny.";
}

$conn->close();
?>
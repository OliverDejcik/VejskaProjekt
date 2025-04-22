<?php
include 'connection.php';

$sql = "SELECT menza.menza_id, menza.nazev, menza.adresa
        FROM menza";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Název Menzy</th><th>Adresa menzy</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nazev']}</td>
                <td>{$row['adresa']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Žádné obědy nebyly nalezeny.";
}

$conn->close();
?>
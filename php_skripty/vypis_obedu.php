<?php
include 'connection.php';

$sql = "SELECT obedy.obed_id, obedy.nazev_obedu, obedy.datum_vydani, obedy.hodnoceni, menza.nazev AS nazev_menzy
        FROM obedy
        JOIN menza ON obedy.menza_id = menza.menza_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Název obědu</th><th>Datum vydání</th><th>Hodnocení</th><th>Menza</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nazev_obedu']}</td>
                <td>{$row['datum_vydani']}</td>
                <td>{$row['hodnoceni']}</td>
                <td>{$row['nazev_menzy']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Žádné obědy nebyly nalezeny.";
}

$conn->close();
?>

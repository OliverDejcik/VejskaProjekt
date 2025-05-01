<?php
function aktualizujPriemerHodnotenia($obed_id, $conn) {
    $stmt = $conn->prepare("SELECT AVG(hodnoceni) AS priemer FROM recenze WHERE obed_id = ?");
    $stmt->bind_param("i", $obed_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $priemer = 0;

    if ($row = $result->fetch_assoc()) {
        $priemer = round($row['priemer'], 2);
    }

    $stmt->close();

    $update = $conn->prepare("UPDATE obedy SET hodnoceni = ? WHERE obed_id = ?");
    $update->bind_param("di", $priemer, $obed_id);
    $update->execute();
    $update->close();
}

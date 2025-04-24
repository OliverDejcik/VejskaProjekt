<?php
require_once "connection.php";

$sql = "SELECT user_id, heslo FROM users";
$result = $conn->query($sql);

$updated = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['user_id'];
        $plainPassword = $row['heslo'];

        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        $updateSql = "UPDATE users SET heslo = ? WHERE user_id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ss", $hashedPassword, $id);
        $stmt->execute();
        $updated++;
    }
    echo "$updated hesiel bolo úspešne zahashovaných.";
} else {
    echo "V databáze nie sú žiadni používatelia.";
}

$conn->close();
?>


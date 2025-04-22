<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Recenze_obedu";

$conn = new mysqli($servername, $username, $password, $dbname);

echo "<!DOCTYPE html><html lang='cs'><head><meta charset='UTF-8'><title>Připojení</title>";
echo "<meta http-equiv='refresh' content='3;url=index.php'>";
echo "<style>
    body { font-family: Arial, sans-serif; padding: 30px; background-color: #f4f4f4; text-align: center; }
    .message { font-size: 20px; margin-top: 50px; }
</style></head><body>";

if ($conn->connect_error) {
    echo "<div class='message'>❌ Připojení selhalo: " . $conn->connect_error . "</div>";
} else {
    echo "<div class='message'>✅ Spojení s databází bylo úspěšné!<br>Za chvíli budete přesměrováni zpět.</div>";
}

$conn->close();
echo "</body></html>";
?>

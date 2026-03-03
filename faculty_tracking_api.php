<?php

<?php

$host = $_ENV['MYSQLHOST'] ?? $_SERVER['MYSQLHOST'];
$user = $_ENV['MYSQLUSER'] ?? $_SERVER['MYSQLUSER'];
$pass = $_ENV['MYSQLPASSWORD'] ?? $_SERVER['MYSQLPASSWORD'];
$db   = $_ENV['MYSQLDATABASE'] ?? $_SERVER['MYSQLDATABASE'];
$port = (int) ($_ENV['MYSQLPORT'] ?? $_SERVER['MYSQLPORT']);

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

echo "Database Connected Successfully!";
?>

$api_key     = $_GET['api_key'] ?? '';
$beacon_uuid = $_GET['beacon_uuid'] ?? '';
$esp_id      = $_GET['esp_id'] ?? '';
$rssi        = intval($_GET['rssi'] ?? 0);

if ($api_key !== "SMARTCAMPUS123") {
    die("Invalid API Key");
}

/* ===== Only allow 10 meter range ===== */
if ($rssi <= -88) {
    die("Outside 10 Meter Range");
}

/* ===== Find Faculty ===== */
$facultyQuery = $conn->prepare("
SELECT id FROM faculty_login 
WHERE LOWER(beacon_uuid) = LOWER(?)
");

$facultyQuery->bind_param("s", $beacon_uuid);
$facultyQuery->execute();
$result = $facultyQuery->get_result();

if (!$row = $result->fetch_assoc()) {
    die("Faculty Not Found");
}

$faculty_id = $row['id'];

/* ===== Always Insert or Update ===== */
$stmt = $conn->prepare("
INSERT INTO faculty_tracking (faculty_id, esp_id, rssi)
VALUES (?, ?, ?)
ON DUPLICATE KEY UPDATE
    esp_id = VALUES(esp_id),
    rssi = VALUES(rssi),
    last_seen = CURRENT_TIMESTAMP
");

$stmt->bind_param("isi", $faculty_id, $esp_id, $rssi);

if ($stmt->execute()) {

    if ($stmt->affected_rows == 1) {
        echo "Inserted";
    } elseif ($stmt->affected_rows == 2) {
        echo "Updated";
    } else {
        echo "No Change";
    }

} else {
    echo "SQL Error: " . $stmt->error;
}

$conn->close();
?>



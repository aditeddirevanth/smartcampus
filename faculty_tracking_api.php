<?php

include "db_connect.php";

$api_key = $_GET['api_key'] ?? '';
$beacon_uuid = $_GET['beacon_uuid'] ?? '';
$esp_id = $_GET['esp_id'] ?? '';
$rssi = intval($_GET['rssi'] ?? 0);

if ($api_key != "SMARTCAMPUS123") {
    die("Invalid API Key");
}

/* Find faculty using MAC address */
$stmt = $conn->prepare("SELECT id FROM faculty_login WHERE beacon_uuid=?");
$stmt->bind_param("s", $beacon_uuid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Faculty Not Found");
}

$row = $result->fetch_assoc();
$faculty_id = $row['id'];

/* Insert or Update with strongest RSSI */
$stmt2 = $conn->prepare("
INSERT INTO faculty_tracking (faculty_id, esp_id, rssi)
VALUES (?, ?, ?)
ON DUPLICATE KEY UPDATE
esp_id = IF(VALUES(rssi) > rssi, VALUES(esp_id), esp_id),
rssi = IF(VALUES(rssi) > rssi, VALUES(rssi), rssi),
last_seen = CURRENT_TIMESTAMP
");

$stmt2->bind_param("isi", $faculty_id, $esp_id, $rssi);
$stmt2->execute();

echo "Updated Successfully";

$conn->close();
?>


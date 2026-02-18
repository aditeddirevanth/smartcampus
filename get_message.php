<?php
include "db_connect.php";

$classroom = $_GET['classroom'];

$sql = "SELECT message FROM announcements 
        WHERE classroom='$classroom' 
        ORDER BY id DESC LIMIT 1";

$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    echo $row['message'];
} else {
    echo "NO_MESSAGE";
}
?>

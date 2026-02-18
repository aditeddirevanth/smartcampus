<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect(
    getenv("MYSQLHOST"),
    getenv("MYSQLUSER"),
    getenv("MYSQLPASSWORD"),
    getenv("MYSQLDATABASE"),
    getenv("MYSQLPORT")
);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

echo "Database Connected Successfully";
?>

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

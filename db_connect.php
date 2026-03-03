<?php

$databaseUrl = getenv("DATABASE_URL");

if (!$databaseUrl) {
    die("DATABASE_URL not found");
}

$url = parse_url($databaseUrl);

$host = $url["host"];
$user = $url["user"];
$pass = $url["pass"];
$db   = ltrim($url["path"], "/");
$port = $url["port"];

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

echo "Database Connected Successfully!";
?>

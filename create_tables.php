<?php
include "db_connect.php";

$sql = "
CREATE TABLE IF NOT EXISTS student_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    Register_Number VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS faculty_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    Register_Number VARCHAR(15) NOT NULL UNIQUE,
    beacon_uuid VARCHAR(50) UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS faculty_tracking (
    faculty_id INT PRIMARY KEY,
    esp_id VARCHAR(30),
    rssi INT,
    last_seen TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (faculty_id) REFERENCES faculty_login(id)
);

CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    classroom VARCHAR(50),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

if (mysqli_multi_query($conn, $sql)) {
    echo "Tables created successfully!";
} else {
    echo "Error creating tables: " . mysqli_error($conn);
}

mysqli_close($conn);

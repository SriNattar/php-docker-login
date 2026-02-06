<?php
$host = "db";          // IMPORTANT: docker-compose service name
$user = "root";
$pass = "root";
$db   = "testdb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

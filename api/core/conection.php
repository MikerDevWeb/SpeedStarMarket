<?php
$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'speed_star_market';

$conn = new mysqli($serverName, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
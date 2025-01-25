<?php
$host = 'localhost:3306';
$user = 'root';
$password = '';
$dbname = 'hotel_menu';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

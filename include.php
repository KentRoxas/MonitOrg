<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_sm3101";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

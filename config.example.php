<?php
// Copy this file to config.php and update the values for your environment.

$servername = getenv('BBRAINY_DB_HOST') ?: 'localhost';
$username   = getenv('BBRAINY_DB_USER') ?: 'root';
$password   = getenv('BBRAINY_DB_PASSWORD') ?: '';
$dbname     = getenv('BBRAINY_DB_NAME') ?: 'my_bbrainy';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed.");
}
?>

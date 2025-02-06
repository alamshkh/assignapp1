<?php
// config.php - Database configuration file
$host = "your-rds-endpoint";
$dbname = "your-database-name";
$username = "your-db-username";
$password = "your-db-password";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

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

<!-- index.php - Main application file -->
<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP MySQL App</title>
</head>
<body>
    <h2>Enter Data</h2>
    <form method="POST">
        <input type="text" name="data" required>
        <button type="submit">Submit</button>
    </form>
    
    <h2>Stored Data</h2>
    <ul>
        <?php
        require 'config.php';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["data"])) {
            $stmt = $pdo->prepare("INSERT INTO records (data) VALUES (:data)");
            $stmt->execute(['data' => $_POST["data"]]);
        }
        
        $stmt = $pdo->query("SELECT * FROM records");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>" . htmlspecialchars($row["data"]) . "</li>";
        }
        ?>
    </ul>
</body>
</html>

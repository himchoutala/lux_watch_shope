<?php
// config.php
$host = 'localhost';
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password  
$database = 'luxury_watches';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<?php
$dsn = 'mysql:host=localhost;dbname=travelbooking';
$username = 'root'; // your MySQL username
$password = ''; // your MySQL password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

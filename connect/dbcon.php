<?php
$localhost = "localhost";
$username = "root"; 
$password = ""; 
$database = "tourist";

try {
    $pdoConnect  = new PDO("mysql:host=$localhost;dbname=$database", $username, $password);
    
    $pdoConnect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
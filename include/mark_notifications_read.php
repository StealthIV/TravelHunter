<?php
require_once '../connect/dbcon.php';
session_start();

$user_id = $_SESSION['id']; // Get the logged-in user's ID
$query = "UPDATE notifications SET read_status = 1 WHERE user_id = :user_id AND read_status = 0"; // Update only unread notifications
$stmt = $pdoConnect->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
?>

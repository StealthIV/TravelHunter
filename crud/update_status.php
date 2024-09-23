<?php
// update_status.php
session_start();
require_once '../connect/dbcon.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    try {
        $stmt = $pdoConnect->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        $stmt->execute(['status' => $status, 'id' => $id]);
        
        header("Location: manage.php"); // Redirect after updating
        exit;
    } catch (PDOException $e) {
        echo "Error updating status: " . $e->getMessage();
    }
}

?>

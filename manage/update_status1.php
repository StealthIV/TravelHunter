<?php
session_start();
require_once '../connect/dbcon.php';

// Check if the ID and status are passed in the URL
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    try {
        // Update the status in the market table
        $pdoQuery = "UPDATE market SET status = :status WHERE id = :id";
        $stmt = $pdoConnect->prepare($pdoQuery);
        $stmt->execute(['status' => $status, 'id' => $id]);

        // Redirect to the manage page after updating
        header("Location: market.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

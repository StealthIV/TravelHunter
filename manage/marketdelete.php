<?php
session_start();
require_once '../connect/dbcon.php';

// Check if the ID is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Delete the record from the market table
        $pdoQuery = "DELETE FROM market WHERE id = :id";
        $stmt = $pdoConnect->prepare($pdoQuery);
        $stmt->execute(['id' => $id]);

        // Redirect back to the manage page after deletion
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

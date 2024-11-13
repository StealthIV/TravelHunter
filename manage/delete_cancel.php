<?php
session_start();
require_once '../connect/dbcon.php';

if (!$user) {
    echo "User not found.";
    exit;
}

// Check if the user is an admin
if ($user['UserRole'] !== 'manager') {
    header("Location: ../include/index.php");  // Redirect to index.php if not an admin
    exit();
}

// Check if the user is logged in and has the right role
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: admin.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Delete the cancellation request
        $deleteQuery = "DELETE FROM cancelbook WHERE id = :id";
        $stmt = $pdoConnect->prepare($deleteQuery);
        $stmt->execute(['id' => $id]);

        // Redirect back to the management page with a success message
        header("Location: req.php");
        exit();
    } catch (PDOException $error) {
        // Handle error
        echo $error->getMessage();
        exit;
    }
} else {
    echo "Invalid request.";
}
?>

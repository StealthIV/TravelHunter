<?php
session_start();
require_once '../connect/dbcon.php';

// Check if the user is logged in and has the right role
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: admin.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Update the status to 'approved'
        $updateQuery = "UPDATE cancelbook SET status = 'approved' WHERE id = :id";
        $stmt = $pdoConnect->prepare($updateQuery);
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

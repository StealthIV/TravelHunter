<?php
session_start();
require_once '../connect/dbcon.php';

// Check if the user is logged in and has the right role
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: admin.php");
    exit();
}

// Ensure the user is a manager
$userId = $_SESSION['id'];
$pdoQuery = "SELECT * FROM user WHERE id = :id";
$stmt = $pdoConnect->prepare($pdoQuery);
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch();

if ($user['UserRole'] !== 'manager') {
    header("Location: ../include/index.php");  // Redirect if not a manager
    exit();
}

// Check if the cancellation request ID is stored in the session
if (isset($_SESSION['cancel_request_id'])) {
    $id = $_SESSION['cancel_request_id'];

    try {
        // Update the status to 'approved'
        $approveQuery = "UPDATE cancelbook SET status = 'approved' WHERE id = :id";
        $stmt = $pdoConnect->prepare($approveQuery);
        $stmt->execute(['id' => $id]);

        // Redirect to the request page after approval
        header("Location: req.php");
        exit();
    } catch (PDOException $error) {
        echo $error->getMessage();
        exit;
    }
} else {
    echo "Invalid request: No cancellation ID found.";
}
?>

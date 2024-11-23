<?php
session_start();
if (!isset($_SESSION["UserName"])) {
    header("location: index.php");
    exit();
}

require_once '../connect/dbcon.php';

if (isset($_GET['id'])) {
    $history_id = $_GET['id'];

    try {
        // Prepare the delete query
        $pdoQuery = "DELETE FROM historybookings WHERE history_id = :history_id";
        $pdoStatement = $pdoConnect->prepare($pdoQuery);
        $pdoStatement->bindParam(':history_id', $history_id, PDO::PARAM_INT);

        // Execute the query
        if ($pdoStatement->execute()) {
            // Redirect to the booking page with a success message
            header("location: categories.php?message=Booking deleted successfully.");
            exit();
        } else {
            // Redirect to the booking page with an error message
            header("location: categories.php?message=Error deleting booking.");
            exit();
        }
    } catch (PDOException $error) {
        echo "Error deleting booking: " . $error->getMessage();
        exit();
    }
} else {
    // Redirect if no ID is provided
    header("location: categories.php?message=No booking ID provided.");
    exit();
}

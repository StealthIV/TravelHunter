<?php
session_start();
require_once '../connect/dbcon.php';

// Check if the session contains a booking ID and action
if (isset($_SESSION['booking_id']) && $_SESSION['action'] == 'delete') {
    $bookingId = $_SESSION['booking_id'];

    // Delete the booking
    $pdoQuery = "DELETE FROM bookings WHERE id = :id";
    $stmt = $pdoConnect->prepare($pdoQuery);
    $stmt->execute(['id' => $bookingId]);

    // Clear session data after use
    unset($_SESSION['booking_id']);
    unset($_SESSION['action']);

    // Redirect back to the bookings page
    header("Location: manage.php");
    exit();
} else {
    echo "No booking ID or action specified.";
}
?>

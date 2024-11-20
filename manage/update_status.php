<?php
session_start();
require_once '../connect/dbcon.php';

// Check if the session contains a booking ID and action
if (isset($_SESSION['booking_id']) && $_SESSION['action'] == 'confirm') {
    $bookingId = $_SESSION['booking_id'];

    try {
        // Begin transaction
        $pdoConnect->beginTransaction();

        // Confirm the booking (update status)
        $pdoQuery = "UPDATE bookings SET status = 'confirmed' WHERE id = :id";
        $stmt = $pdoConnect->prepare($pdoQuery);
        $stmt->execute(['id' => $bookingId]);

        // Fetch the booking information
        $bookingQuery = $pdoConnect->prepare("SELECT * FROM bookings WHERE id = :id");
        $bookingQuery->execute(['id' => $bookingId]);
        $booking = $bookingQuery->fetch(PDO::FETCH_ASSOC);

        if ($booking) {
            // Insert a notification for the user with a custom message
            $notificationMessage = "Your booking is accepted for check-in on " . htmlspecialchars($booking['checkin']);
            $notificationQuery = $pdoConnect->prepare("
                INSERT INTO notifications (name, booking_date, user_id, status, created_at) 
                VALUES (:name, :booking_date, :user_id, :status, NOW())
            ");
            $notificationQuery->execute([
                'name' => $notificationMessage,
                'booking_date' => $booking['checkin'],
                'user_id' => $booking['user_id'],
                'status' => 'Accepted', // Set status as Accepted
            ]);

            // Insert record into historybookings
            $historyQuery = $pdoConnect->prepare("
                INSERT INTO historybookings (user_id, phone, days, checkin, package, guests, amount, payment, Reference)
                VALUES (:user_id, :phone, :days, :checkin, :package, :guests, :amount, :payment, :Reference)
            ");
            $historyQuery->execute([
                'user_id' => $booking['user_id'],
                'phone' => $booking['phone'],
                'days' => $booking['days'],
                'checkin' => $booking['checkin'],
                'package' => $booking['package'],
                'guests' => $booking['guests'],
                'amount' => $booking['amount'],
                'payment' => $booking['payment'],
                'Reference' => $booking['Reference']
            ]);

            // Commit the transaction
            $pdoConnect->commit();

            // Clear session data after use
            unset($_SESSION['booking_id']);
            unset($_SESSION['action']);

            // Redirect back to the bookings page
            header("Location: manage.php");
            exit();
        } else {
            echo "Error: Booking data not found.";
            exit;
        }
    } catch (PDOException $e) {
        // Rollback the transaction if something fails
        $pdoConnect->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No booking ID or action specified.";
}
?>

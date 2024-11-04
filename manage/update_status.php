<?php
session_start();
require_once '../connect/dbcon.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    try {
        // Begin transaction
        $pdoConnect->beginTransaction();

        // Update booking status
        $stmt = $pdoConnect->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        $stmt->execute(['status' => $status, 'id' => $id]);

        // Fetch booking information
        $bookingQuery = $pdoConnect->prepare("SELECT * FROM bookings WHERE id = :id");
        $bookingQuery->execute(['id' => $id]);
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
        } else {
            echo "Error: Booking data not found.";
            exit;
        }

        // Redirect after updating
        header("Location: manage.php");
        exit;
    } catch (PDOException $e) {
        // Rollback the transaction if something fails
        $pdoConnect->rollBack();
        echo "Error updating status: " . $e->getMessage();
    }
} else {
    echo "Invalid request: Booking ID or status is missing.";
}
?>

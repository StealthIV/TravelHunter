<?php
// update_status.php
session_start();
require_once '../connect/dbcon.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    try {
        // Update booking status
        $stmt = $pdoConnect->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        $stmt->execute(['status' => $status, 'id' => $id]);

        // Fetch user information related to the booking
        $bookingQuery = $pdoConnect->prepare("SELECT user_id, checkin FROM bookings WHERE id = :id");
        $bookingQuery->execute(['id' => $id]);
        $booking = $bookingQuery->fetch(PDO::FETCH_ASSOC);

        if ($booking) {
            // Insert a notification for the user with a custom message
            $notificationMessage = "Your booking is accepted for check-in on " . $booking['checkin'];
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
        }

        // Redirect after updating
        header("Location: manage.php");
        exit;
    } catch (PDOException $e) {
        echo "Error updating status: " . $e->getMessage();
    }
}
?>

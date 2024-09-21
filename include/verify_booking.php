<?php
session_start();
require_once '../connect/dbcon.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$bookingId = $input['bookingId'];
$email = $input['email'];

// Prepare and execute query to check if the booking exists with the provided email
try {
    $stmt = $pdoConnect->prepare("SELECT * FROM bookings WHERE id = :bookingId AND email = :email");
    $stmt->execute([':bookingId' => $bookingId, ':email' => $email]);
    $booking = $stmt->fetch();

    if ($booking) {
        echo json_encode(['valid' => true]);
    } else {
        echo json_encode(['valid' => false]);
    }
} catch (PDOException $error) {
    echo json_encode(['valid' => false, 'error' => $error->getMessage()]);
}
?>

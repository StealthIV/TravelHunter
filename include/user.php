<?php
session_start();
if (!isset($_SESSION["UserName"])) {
    header("Location: ../index.php");
    exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

// Fetch the logged-in user's details
try {
    $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['UserName' => $UserName]);
    $user = $pdoResult->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        die("User not found.");
    }
    $profile_image = $user['image']; // Assuming this is the URL to the profile image
} catch (PDOException $error) {
    echo $error->getMessage();
    exit();
}

// If the request method is POST, process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if it's a booking submission
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['days'], $_POST['checkin'], $_POST['package'], $_POST['guests'], $_POST['amount'], $_POST['payment'], $_POST['Reference'])) {
        // Booking Submission
        try {
            // After inserting the booking into the database
            $stmt = $pdoConnect->prepare("
INSERT INTO bookings (name, email, phone, days, checkin, package, guests, amount, payment, Reference)
VALUES (:name, :email, :phone, :days, :checkin, :package, :guests, :amount, :payment, :Reference)
");
            $stmt->execute([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'days' => $_POST['days'],
                'checkin' => $_POST['checkin'],
                'package' => $_POST['package'],
                'guests' => $_POST['guests'],
                'amount' => $_POST['amount'],
                'payment' => $_POST['payment'],
                'Reference' => $_POST['Reference']
            ]);

            // Get the last inserted ID
            $booking_id = $pdoConnect->lastInsertId();

            // Store it in the session
            $_SESSION['booking_id'] = $booking_id;

            // Redirect to the receipt page or wherever necessary
            header("Location: receipt.php");
            exit();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
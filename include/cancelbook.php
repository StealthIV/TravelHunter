<?php
session_start();
require_once '../connect/dbcon.php';

// Check if the user is logged in
if (!isset($_SESSION["UserName"])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$name = $email = $phone = $request = $reason = $bookingId = $refundMethod = $receiverNum = $rebookingDate = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign POST data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $request = htmlspecialchars(trim($_POST["Request"]));
    $reason = htmlspecialchars(trim($_POST["Reason"]));
    $bookingId = htmlspecialchars(trim($_POST["Booking_Id"]));
    $refundMethod = htmlspecialchars(trim($_POST["refundmethod"]));
    $receiverNum = htmlspecialchars(trim($_POST["receivernum"]));
    $rebookingDate = htmlspecialchars(trim($_POST["rebooking"]));
    $enteredPassword = htmlspecialchars(trim($_POST["password"])); // Retrieve the password from the form

    // Check if all required fields are filled
    if (empty($name) || empty($email) || empty($phone) || empty($request) || empty($reason) || empty($bookingId) || empty($enteredPassword)) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: boracaycancel.php");
        exit();
    }

    // Fetch the logged-in user's details to verify the password
    try {
        $userQuery = "SELECT * FROM user WHERE UserName = :username";
        $userStmt = $pdoConnect->prepare($userQuery);
        $userStmt->execute(['username' => $_SESSION["UserName"]]);
        $user = $userStmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($enteredPassword, $user['PassWord'])) {
            // If the user doesn't exist or the password doesn't match
            $_SESSION['error'] = "Incorrect password. Please try again.";
            header("Location: boracaycancel.php");
            exit();
        }

        // Check if the Booking ID exists in the 'bookings' table
        $checkBookingQuery = "SELECT * FROM bookings WHERE id = :bookingId";
        $stmt = $pdoConnect->prepare($checkBookingQuery);
        $stmt->bindParam(':bookingId', $bookingId, PDO::PARAM_INT);
        $stmt->execute();
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$booking) {
            $_SESSION['error'] = "Booking ID does not exist.";
            header("Location: boracaycancel.php");
            exit();
        }

        // Prepare SQL statement to insert the cancellation request into the database
        $sql = "INSERT INTO cancelbook (name, email, phone, request_type, reason, booking_id, refund_method, receiver_number, rebooking_date) 
                VALUES (:name, :email, :phone, :request, :reason, :booking_id, :refund_method, :receiver_number, :rebooking_date)";

        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':request' => $request,
            ':reason' => $reason,
            ':booking_id' => $bookingId,
            ':refund_method' => $refundMethod,
            ':receiver_number' => $receiverNum,
            ':rebooking_date' => $rebookingDate
        ]);

        // Success message and redirect
        $_SESSION['message'] = "Cancellation request submitted successfully!";
        header("Location: boracaycancel.php");
        exit();

    } catch (PDOException $error) {
        // Handle error
        $_SESSION['error'] = "Error: " . $error->getMessage();
        header("Location: boracaycancel.php");
        exit();
    }
} else {
    // Redirect if the form is not submitted properly
    header("Location: boracaycancel.php");
    exit();
}
?>

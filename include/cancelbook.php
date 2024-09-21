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

    // Prepare SQL statement to insert the cancellation request into the database
    try {
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

        // Redirect or display success message
        header("Location: boracaycancel.php");
        exit();
        
    } catch (PDOException $error) {
        // Handle error
        echo "Error: " . $error->getMessage();
        exit();
    }
} else {
    // Redirect if the form is not submitted properly
    header("Location: boracaycancel.php");
    exit();
}
?>

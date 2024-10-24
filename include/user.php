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

// If the request method is POST, process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['days'], $_POST['checkin'], $_POST['package'], $_POST['guests'], $_POST['downpayment'], $_POST['balance'], $_POST['payment'], $_POST['Reference'])) {
        
        // Sanitize and format the downpayment and balance values
        $downpayment = floatval(str_replace(['₱', ','], '', $_POST['downpayment'])); // Remove currency symbols and commas
        $balance = floatval(str_replace(['₱', ','], '', $_POST['balance']));

        // Insert the data into the database
        try {
            $stmt = $pdoConnect->prepare("
                INSERT INTO bookings (name, email, phone, days, checkin, package, guests, downpayment, balance, payment, Reference, status)
                VALUES (:name, :email, :phone, :days, :checkin, :package, :guests, :downpayment, :balance, :payment, :Reference, :status)
            ");
            $stmt->execute([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'days' => $_POST['days'],
                'checkin' => $_POST['checkin'],
                'package' => $_POST['package'],
                'guests' => $_POST['guests'],
                'downpayment' => $downpayment,
                'balance' => $balance,
                'payment' => $_POST['payment'],
                'Reference' => $_POST['Reference'],
                'status' => 'pending' // Default status
            ]);

            // Get the last inserted booking ID
            $booking_id = $pdoConnect->lastInsertId();

            // Store it in the session for later use (e.g., generating receipts)
            $_SESSION['booking_id'] = $booking_id;

            // Redirect to the receipt page
            header("Location: receipt.php");
            exit();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
        exit();
    }
}
?>

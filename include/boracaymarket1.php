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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all fields including 'item' are set
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['checkin'], $_POST['item'], $_POST['quantity'], $_POST['downpayment'], $_POST['balance'], $_POST['payment'], $_POST['Reference'])) {

        // Ensure that the user selected an item
        if (empty($_POST['item'])) {
            echo "Please choose an item.";
            exit();
        }

        // Insert into the database
        try {
            $stmt = $pdoConnect->prepare("
            INSERT INTO market (name, email, phone, address, checkin, item, quantity, downpayment, balance, payment, Reference, status)
            VALUES (:name, :email, :phone, :address, :checkin, :item, :quantity, :downpayment, :balance, :payment, :Reference, :status)
            ");
            $stmt->execute([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'checkin' => $_POST['checkin'],
                'item' => $_POST['item'], // This is the chosen item from the select dropdown
                'quantity' => $_POST['quantity'],
                'downpayment' => $_POST['downpayment'],
                'balance' => $_POST['balance'],
                'payment' => $_POST['payment'],
                'Reference' => $_POST['Reference'],
                'status' => 'pending'
            ]);

            // Get the last inserted ID
            $order_id = $pdoConnect->lastInsertId();

            // Store it in the session
            $_SESSION['order_id'] = $order_id;

            // Redirect to the receipt page or wherever necessary
            header("Location: receiptmarket.php");
            exit();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
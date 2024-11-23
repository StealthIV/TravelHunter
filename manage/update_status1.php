<?php
session_start();
require_once '../connect/dbcon.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../include/phpmailer/src/Exception.php';
require_once '../include/phpmailer/src/PHPMailer.php';
require_once '../include/phpmailer/src/SMTP.php';

// Check if the ID and status are passed in the URL
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    try {
        // Begin transaction
        $pdoConnect->beginTransaction();

        // Update the status in the market table
        $pdoQuery = "UPDATE market SET status = :status WHERE id = :id";
        $stmt = $pdoConnect->prepare($pdoQuery);
        $stmt->execute(['status' => $status, 'id' => $id]);

        // Fetch the user's email and other relevant details from the market table
        $marketQuery = "SELECT email, name, Item, quantity FROM market WHERE id = :id";
        $marketStmt = $pdoConnect->prepare($marketQuery);
        $marketStmt->execute(['id' => $id]);
        $marketDetails = $marketStmt->fetch(PDO::FETCH_ASSOC);

        $userEmail = $marketDetails['email'];
        $userName = $marketDetails['name'];
        $itemName = $marketDetails['Item'];
        $itemQuantity = $marketDetails['quantity'];

        // Send notification email to the user
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'huntertravel150@gmail.com'; // Your email address
            $mail->Password = 'igvxyavzuysqskby'; // Your SMTP password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Recipients
            $mail->setFrom('cferdinand500@gmail.com', 'Travel Hunter');
            $mail->addAddress($userEmail); // Send email to the user

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Order Status Updated';

            // Email body
            $emailContent = "
                <h1>Order Status Update</h1>
                <p>Dear {$userName},</p>
                <p>Your order for the following item(s) has been updated:</p>
                <ul>
                    <li><strong>Item:</strong> {$itemName}</li>
                    <li><strong>Quantity:</strong> {$itemQuantity}</li>
                    <li><strong>New Status:</strong> {$status}</li>
                </ul>
                <p>Thank you for shopping with us. If you have any questions, feel free to contact us.</p>
            ";

            $mail->Body = $emailContent;

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            echo "Error sending email: " . $mail->ErrorInfo;
        }

        // Commit the transaction
        $pdoConnect->commit();

        // Redirect to the manage page after updating
        header("Location: market.php");
        exit();

    } catch (PDOException $e) {
        // Rollback the transaction in case of an error
        $pdoConnect->rollBack();
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<?php
session_start();
require_once '../connect/dbcon.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../include/phpmailer/src/Exception.php';
require_once '../include/phpmailer/src/PHPMailer.php';
require_once '../include/phpmailer/src/SMTP.php';

// Check if the user is logged in and has the right role
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: admin.php");
    exit();
}

$userId = $_SESSION['id'];
$pdoQuery = "SELECT * FROM user WHERE id = :id";
$stmt = $pdoConnect->prepare($pdoQuery);
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch();

// Check if the cancellation request ID is stored in the session
if (isset($_SESSION['cancel_request_id'])) {
    $id = $_SESSION['cancel_request_id'];

    try {
        // Begin transaction
        $pdoConnect->beginTransaction();

        // Update the status to 'approved'
        $approveQuery = "UPDATE cancelbook SET status = 'approved' WHERE id = :id";
        $stmt = $pdoConnect->prepare($approveQuery);
        $stmt->execute(['id' => $id]);

        // Fetch the cancellation details, including email
        $cancelQuery = $pdoConnect->prepare("SELECT * FROM cancelbook WHERE id = :id");
        $cancelQuery->execute(['id' => $id]);
        $cancelRequest = $cancelQuery->fetch(PDO::FETCH_ASSOC);
        $userEmail = $cancelRequest['email']; // Directly use the email field from cancelbook

        // Send approval email to the user
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
            $mail->Subject = 'Cancellation Request Approved';

            // Email body
            $emailContent = "
                <h1>Your Cancellation Request Has Been Approved</h1>
                <p><strong>Booking ID:</strong> {$cancelRequest['booking_id']}</p>
                <p><strong>Cancellation Date:</strong> {$cancelRequest['cancel_date']}</p>
                <p><strong>Status:</strong> Approved</p>
                <p>We have successfully processed your cancellation request. If you have any further inquiries, feel free to contact us.</p>
            ";

            $mail->Body = $emailContent;

            // Send email
            $mail->send();
        } catch (Exception $e) {
            echo "Error sending email: " . $mail->ErrorInfo;
        }

        // Commit the transaction
        $pdoConnect->commit();

        // Redirect to the request page after approval
        header("Location: req.php");
        exit();

    } catch (PDOException $error) {
        // Rollback the transaction if something fails
        $pdoConnect->rollBack();
        echo $error->getMessage();
        exit;
    }
} else {
    echo "Invalid request: No cancellation ID found.";
}
?>

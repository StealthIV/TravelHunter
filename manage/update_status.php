<?php
session_start();
require_once '../connect/dbcon.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../include/phpmailer/src/Exception.php';
require_once '../include/phpmailer/src/PHPMailer.php';
require_once '../include/phpmailer/src/SMTP.php';

// Check if the session contains a booking ID and action
if (isset($_SESSION['booking_id']) && $_SESSION['action'] == 'confirm') {
    $bookingId = $_SESSION['booking_id'];

    try {
        // Begin transaction
        $pdoConnect->beginTransaction();

        // Confirm the booking (update status)
        $pdoQuery = "UPDATE bookings SET status = 'confirmed' WHERE id = :id";
        $stmt = $pdoConnect->prepare($pdoQuery);
        $stmt->execute(['id' => $bookingId]);

        // Fetch the booking information
        $bookingQuery = $pdoConnect->prepare("SELECT * FROM bookings WHERE id = :id");
        $bookingQuery->execute(['id' => $bookingId]);
        $booking = $bookingQuery->fetch(PDO::FETCH_ASSOC);

        if ($booking) {
            // Fetch user email (UserName) from user table using user_id
            $userQuery = $pdoConnect->prepare("SELECT UserName FROM user WHERE id = :user_id");
            $userQuery->execute(['user_id' => $booking['user_id']]);
            $user = $userQuery->fetch(PDO::FETCH_ASSOC);
            $userEmail = $user['UserName']; // Assuming UserName is the email address

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
            $downpayment = isset($booking['downpayment']) ? $booking['downpayment'] : 0;
            $balance = isset($booking['balance']) ? $booking['balance'] : 0;

            $historyQuery = $pdoConnect->prepare("
                INSERT INTO historybookings (user_id, phone, days, checkin, package, guests, amount, payment, Reference, downpayment, balance)
                VALUES (:user_id, :phone, :days, :checkin, :package, :guests, :amount, :payment, :Reference, :downpayment, :balance)
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
                'Reference' => $booking['Reference'],
                'downpayment' => $downpayment,
                'balance' => $balance
            ]);

            // Send confirmation email
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
                $mail->Subject = 'Booking Confirmation';

                // Email body
                $emailContent = "
                    <h1>Your Booking is Confirmed!</h1>
                    <p><strong>Booking ID:</strong> {$booking['id']}</p>
                    <p><strong>Check-in Date:</strong> {$booking['checkin']}</p>
                    <p><strong>Package:</strong> {$booking['package']}</p>
                    <p><strong>Guests:</strong> {$booking['guests']}</p>
                    <p><strong>Amount:</strong> {$booking['amount']}</p>
                    <p><strong>Downpayment:</strong> {$booking['downpayment']}</p>
                    <p><strong>Balance:</strong> {$booking['balance']}</p>
                    <p><strong>Payment Method:</strong> {$booking['payment']}</p>
                    <p><strong>Reference Number:</strong> {$booking['Reference']}</p>
                    <p>We look forward to your stay with us. If you have any questions, feel free to reach out!</p>
                ";

                $mail->Body = $emailContent;

                // Send email
                $mail->send();
            } catch (Exception $e) {
                echo "Error sending email: " . $mail->ErrorInfo;
            }

            // Commit the transaction
            $pdoConnect->commit();

            // Clear session data after use
            unset($_SESSION['booking_id']);
            unset($_SESSION['action']);

            // Redirect back to the bookings page
            header("Location: manage.php");
            exit();
        } else {
            echo "Error: Booking data not found.";
            exit;
        }
    } catch (PDOException $e) {
        // Rollback the transaction if something fails
        $pdoConnect->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No booking ID or action specified.";
}
?>

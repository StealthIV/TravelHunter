<?php
session_start();

require_once 'phpmailer/src/Exception.php';
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        $verificationCode = rand(100000, 999999); // Generate a random 6-digit code

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'huntertravel150@gmail.com';
            $mail->Password = 'igvxyavzuysqskby'; // Use environment variables in production
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('cferdinand500@gmail.com', 'Your Name');
            $mail->addAddress($email); // Recipient's email

            $mail->isHTML(true);
            $mail->Subject = 'Verification Code';
            $mail->Body = "Your verification code is: <strong>$verificationCode</strong>";

            $mail->send();

            // Store the verification code in the session
            $_SESSION['verification_code'] = $verificationCode;
            $_SESSION['email'] = $email; // Store email for verification
            echo "Verification code sent to $email. Please check your email.";
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } elseif (isset($_POST['verification_code'])) {
        // Verify the entered verification code
        $inputCode = $_POST['verification_code'];
        if ($inputCode == $_SESSION['verification_code']) {
            echo "Verification successful! Welcome, {$_SESSION['email']}.";
            // Proceed with your logic after successful verification
        } else {
            echo "Invalid verification code. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Send Verification Code</title>
</head>

<body>
    <form method="POST" action="">
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Send Verification Code</button>
    </form>

    <?php if (isset($_SESSION['verification_code'])): ?>
        <form method="POST" action="">
            <label for="verification_code">Enter Verification Code:</label>
            <input type="text" id="verification_code" name="verification_code" required>
            <button type="submit">Verify Code</button>
        </form>
    <?php endif; ?>
</body>

</html>
<?php
session_start();
require_once '../connect/dbcon.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendPasswordEmail($email, $resetLink)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Update with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'cferdinand500@gmail.com'; // Update with your email address
        $mail->Password = 'ltmcxkilncsryrft'; // Update with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 25;

        // Recipients 
        $mail->setFrom('TravelHunter@gmail.com', 'TravelHunter'); // Update with your email and name
        $mail->addAddress($email); // Use the provided email parameter

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Password Reset";
        $mail->Body = "Dear user,<br><br>If you requested a password reset, please click on the following link to reset your password:<br><br><a href=\"$resetLink\">Reset Password</a><br><br>If you did not request this, please ignore this email.<br><br>Best regards,<br>Your Company";

        $mail->send();
        $message = "Password reset link sent to your email.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_request'])) {
    $userName = $_POST['UserName'];

    // Check if the email exists in the database
    $stmt = $pdoConnect->prepare("SELECT * FROM info WHERE email = ?");
    $stmt->execute([$userName]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a unique token (you may use a library for this)
        $resetToken = bin2hex(random_bytes(32));

        // Store the token in the database, associating it with the user's account
        $stmt = $pdoConnect->prepare("UPDATE info SET reset_token = ? WHERE email = ?");
        $stmt->execute([$resetToken, $userName]);

        // Create a generic reset link without revealing the path
        $resetLink = "http://localhost/yay/include/pass.php/reset-password?token=$resetToken";

        // Call the function to send the email
        sendPasswordEmail($userName, $resetLink);
    } else {
        $message = "Email not found. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/reset.css">
    <title>Password Reset</title>
</head>

<body>
    <div class="main">
        <section class="forgot-password">
            <div class="container">
                <div class="forgot-password-content">
                    <h2 class="form-title">Forgot Your Password?</h2>
                    <?php if (isset($message)): ?>
                        <div class="warning-message">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                        class="forgot-password-form">
                        <div class="form-group">
                            <input type="text" name="UserName" id="your_name" placeholder="Your Email" />
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="reset_request" class="form-submit" value="Reset Password" />
                        </div>
                    </form>
                    <div class="back-link">
                        <a href="login.php">Back to Login</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
<?php
require_once '../connect/dbcon.php';

session_start();
if (!isset($_SESSION["UserName"]) || !isset($_SESSION['booking_id'])) {
  header("location: index.php");
  exit();
}

// Use the booking ID from the session
$booking_id = $_SESSION['booking_id'];

// Fetch booking details from the database
$stmt = $pdoConnect->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->execute([$booking_id]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$booking) {
  die("Booking not found!");
}


$UserName = $_SESSION["UserName"];

// Fetching user profile image from the database
try {
  $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['UserName' => $UserName]);
  $user = $pdoResult->fetch();
  $profile_image = $user['image']; // Assuming this is the URL to the profile image
} catch (PDOException $error) {
  echo $error->getMessage();
  exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/src/Exception.php';
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';

// Extract and validate email address
$email = $booking['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die('Invalid email address.');
}

// Email configuration
$mail = new PHPMailer(true);
$emailSent = false;
$mailError = '';

try {
  // Server settings
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;

  // Load credentials from environment variables or hardcoded values
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
  $mail->addAddress($email, $booking['name']); // Use $booking['name']

  // Content
  $mail->isHTML(true);
  $mail->Subject = 'Booking Receipt';

  // Create email body
  $emailContent = "
        <h1>Booking Receipt</h1>
        <p><strong>Booking ID:</strong> {$booking['id']}</p>
        <p><strong>Name:</strong> {$booking['name']}</p>
        <p><strong>Email:</strong> {$booking['email']}</p>
        <p><strong>Phone:</strong> {$booking['phone']}</p>
        <p><strong>Number of Days:</strong> {$booking['days']}</p>
        <p><strong>Booking Date:</strong> {$booking['checkin']}</p>
        <p><strong>Package:</strong> {$booking['package']}</p>
        <p><strong>Number of Guests:</strong> {$booking['guests']}</p>
        <p><strong>Total Amount:</strong> {$booking['amount']}</p>
        <p><strong>Payment Method:</strong> {$booking['payment']}</p>
        <p><strong>Reference Number:</strong> {$booking['Reference']}</p>
    ";

  $mail->Body = $emailContent;

  // Send email
  $mail->send();
  $emailSent = true;
} catch (Exception $e) {
  $emailSent = false;
  $mailError = $mail->ErrorInfo;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Hunter</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../style/receipt.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>

  <?php require_once "nav.php" ?>

  <section class="overlay"></section>

  <section class="main">
    <div class="form">
      <h1>Booking Receipt</h1>

      <?php if ($emailSent): ?>
        <p><strong>Booking ID:</strong> <?= htmlspecialchars($booking['id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($booking['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
        <p><strong>Number of Days:</strong> <?= htmlspecialchars($booking['days']) ?></p>
        <p><strong>Booking Date:</strong> <?= htmlspecialchars($booking['checkin']) ?></p>
        <p><strong>Package:</strong> <?= htmlspecialchars($booking['package']) ?></p>
        <p><strong>Number of Guests:</strong> <?= htmlspecialchars($booking['guests']) ?></p>
        <p><strong>Total Amount:</strong> <?= htmlspecialchars($booking['amount']) ?></p>
        <p><strong>Payment Method:</strong> <?= htmlspecialchars($booking['payment']) ?></p>
        <p><strong>Reference Number:</strong> <?= htmlspecialchars($booking['Reference']) ?></p>
        <button onclick="window.print()">Print Receipt</button>
      <?php else: ?>
        <p>Failed to send email. Please contact support. Error: <?= htmlspecialchars($mailError) ?></p>
      <?php endif; ?>

    </div>  
  </section>

  <script src="../js/home.js"></script>
  <script src="../js/language.js"></script>
</body>

</html>

<?php // Clear the booking ID after use
unset($_SESSION['booking_id']);
?>
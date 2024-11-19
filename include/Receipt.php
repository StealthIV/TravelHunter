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

// Fetch user details using user_id from the bookings table
$user_id = $booking['user_id'];
try {
  // Fetch user details from the user table using the user_id
  $pdoQuery = "SELECT FullName, UserName FROM user WHERE id = :user_id";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['user_id' => $user_id]);
  $user = $pdoResult->fetch();

  // Assign user details
  $full_name = $user['FullName'];
  $email = $user['UserName']; // Assuming UserName holds the email

} catch (PDOException $error) {
  echo $error->getMessage() . '';
  exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/src/Exception.php';
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';

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
  $mail->addAddress($email, $full_name); // Use $full_name from user table

  // Content
  $mail->isHTML(true);
  $mail->Subject = 'Booking Receipt';

  // Create email body
  $emailContent = "
        <h1>Booking Receipt</h1>
        <p><strong>Booking ID:</strong> {$booking['id']}</p>
        <p><strong>Name:</strong> {$full_name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$booking['phone']}</p>
        <p><strong>Number of Days:</strong> {$booking['days']}</p>
        <p><strong>Booking Date:</strong> {$booking['checkin']}</p>
        <p><strong>Package:</strong> {$booking['package']}</p>
        <p><strong>Number of Guests:</strong> {$booking['guests']}</p>
        <p><strong>Downpayment:</strong> {$booking['downpayment']}</p>
        <p><strong>Balance:</strong> {$booking['balance']}</p>
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
  <title>Booking Receipt</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../style/receipt.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>

  <?php require_once "nav.php"; ?>

  <section class="overlay"></section>

  <section class="main">
    <div class="form" id="receipt">
      <h1>Booking Receipt</h1>

      <?php if ($emailSent): ?>
        <p><strong>Booking ID:</strong> <?= htmlspecialchars($booking['id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($full_name) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
        <p><strong>Number of Days:</strong> <?= htmlspecialchars($booking['days']) ?></p>
        <p><strong>Booking Date:</strong> <?= htmlspecialchars($booking['checkin']) ?></p>
        <p><strong>Package:</strong> <?= htmlspecialchars($booking['package']) ?></p>
        <p><strong>Number of Guests:</strong> <?= htmlspecialchars($booking['guests']) ?></p>
        <p><strong>Downpayment:</strong> <?= htmlspecialchars($booking['downpayment']) ?></p>
        <p><strong>Balance:</strong> <?= htmlspecialchars($booking['balance']) ?></p>
        <p><strong>Payment Method:</strong> <?= htmlspecialchars($booking['payment']) ?></p>
        <p><strong>Reference Number:</strong> <?= htmlspecialchars($booking['Reference']) ?></p>
        <a class="download-button" id="downloadReceipt">Download Receipt</a>
      <?php else: ?>
        <p>Failed to send email. Please contact support. Error: <?= htmlspecialchars($mailError) ?></p>
      <?php endif; ?>

    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script>
    document.getElementById("downloadReceipt").addEventListener("click", function () {
      const receiptElement = document.getElementById("receipt");

      // Use html2canvas to render the receipt as an image
      html2canvas(receiptElement).then(canvas => {
        // Convert the canvas to a data URL
        const link = document.createElement("a");
        link.download = "Booking_Receipt.jpg"; // File name
        link.href = canvas.toDataURL("image/jpeg", 1.0); // JPG format
        link.click(); // Trigger the download
      });
    });
  </script>
</body>
</html>

<?php
// Clear the booking ID after use
unset($_SESSION['booking_id']);
?>
  
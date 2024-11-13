<?php
session_start();

if (!isset($_SESSION['UserName'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputCode = $_POST['verification_code'];

    // Compare input verification code with stored code in session
    if ($inputCode == $_SESSION['verification_code']) {
        // Clear the verification code from session
        unset($_SESSION['verification_code']);
        
        // Redirect to the appropriate dashboard based on user role
        if ($_SESSION["UserRole"] == "admin") {
            header("Location: ../admin/admin.php");
        } elseif ($_SESSION["UserRole"] == "manager") {
            header("Location: ../manage/manage.php");
        }
        exit();
    } else {
        $_SESSION['error'] = "Invalid verification code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
</head>
<body>
    <h2>Verify Your Account</h2>
    <?php if (isset($_SESSION['error'])) { echo "<p>{$_SESSION['error']}</p>"; unset($_SESSION['error']); } ?>
    <form method="POST">
        <label for="verification_code">Enter Verification Code:</label>
        <input type="text" name="verification_code" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>

<?php

session_start();
require_once '../connect/dbcon.php'; // Database connection

if (isset($_POST['verify_code'])) {
    $enteredCode = $_POST['verification_code'];

    try {
        // Check if the entered verification code matches the one in the database and if the user is not already verified
        $pdoQuery = "SELECT * FROM user WHERE verification_code = :verification_code AND is_verified = 0";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute([':verification_code' => $enteredCode]);
        $user = $pdoResult->fetch();

        if ($user) {
            // If a user is found and not verified, mark them as verified
            $updateQuery = "UPDATE user SET is_verified = 1 WHERE verification_code = :verification_code";
            $pdoResult = $pdoConnect->prepare($updateQuery);
            $pdoResult->execute([':verification_code' => $enteredCode]);

            // You can also check the user role if necessary and redirect to a specific page (e.g., 'admin' or 'user')
            if ($user['UserRole'] == 'admin') {
                $_SESSION['success'] = "Your email has been successfully verified, and you are an admin!";
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            } else {
                $_SESSION['success'] = "Your email has been successfully verified!";
                header("Location: home.php"); // Redirect to home page for regular users
            }

            exit();
        } else {
            $_SESSION['error'] = "Invalid or already verified verification code.";
            header("Location: verify.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: verify.php");
        exit();
    }
}
?>

<!-- HTML Form to enter the verification code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account</title>
</head>
<body>

    <h2>Verify Your Email</h2>
    
    <form action="verify.php" method="post">
        <label for="verification_code">Enter Verification Code:</label><br>
        <input type="text" name="verification_code" id="verification_code" required><br><br>
        <input type="submit" name="verify_code" value="Verify">
    </form>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    ?>

</body>
</html>

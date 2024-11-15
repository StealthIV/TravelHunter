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

            $_SESSION['success'] = "Your email has been successfully verified!";
            header("Location: home.php");
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
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url(../img/qqqq.jpg);
            color: #333;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #666;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            outline: none;
            transition: border 0.3s;
        }

        input[type="text"]:focus {
            border-color: #007bff;
        }

        input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .message.error {
            color: #d9534f;
        }

        .message.success {
            color: #5cb85c;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Verify Your Email</h2>

        <form action="verify.php" method="post">
            <div class="form-group">
                <label for="verification_code">Enter Verification Code:</label>
                <input type="text" name="verification_code" id="verification_code" required maxlength="6"
                    pattern="[0-9A-Za-z]{6}" title="Please enter a 6-character code">

            </div>
            <input type="submit" name="verify_code" value="Verify">
        </form>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="message error"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <p class="message success"><?php echo $_SESSION['success']; ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </div>

</body>

</html>
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
            $_SESSION["UserName"] = $user["UserName"];
            $_SESSION["UserRole"] = $user["UserRole"];
            $_SESSION["id"] = $user["id"];
    
            header("Location: ../admin/admin.php");
        } elseif ($_SESSION["UserRole"] == "manager") {
            $_SESSION["UserName"] = $user["UserName"];
            $_SESSION["UserRole"] = $user["UserRole"];
            $_SESSION["id"] = $user["id"];
    
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
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url(../img/qqqq.jpg);
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

        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .message.error {
            color: #d9534f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Verify Your Account</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="message error"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="verification_code">Enter Verification Code:</label>
                <input type="text" name="verification_code" id="verification_code" required maxlength="6"
                    pattern="[0-9A-Za-z]{6}" title="Please enter a 6-character code">
            </div>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>

</html>
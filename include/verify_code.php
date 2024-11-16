<?php
session_start();

if (!isset($_SESSION['UserName'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputCode = implode("", $_POST['verification_code']); // Combine input boxes into one code

    // Compare input verification code with stored code in session
    if ($inputCode == $_SESSION['verification_code']) {
        unset($_SESSION['verification_code']); // Clear the verification code from session

        // Redirect based on user role
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
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url(../img/qqqq.jpg);
            background-size: cover;
            background-position: center;
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

        .verification-code {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .verification-code input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s;
        }

        .verification-code input:focus {
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
            <div class="verification-code">
                <input type="text" name="verification_code[]" maxlength="1" pattern="[A-Za-z0-9]" required>
                <input type="text" name="verification_code[]" maxlength="1" pattern="[A-Za-z0-9]" required>
                <input type="text" name="verification_code[]" maxlength="1" pattern="[A-Za-z0-9]" required>
                <input type="text" name="verification_code[]" maxlength="1" pattern="[A-Za-z0-9]" required>
                <input type="text" name="verification_code[]" maxlength="1" pattern="[A-Za-z0-9]" required>
                <input type="text" name="verification_code[]" maxlength="1" pattern="[A-Za-z0-9]" required>
            </div>
            <button type="submit">Verify</button>
        </form>
    </div>

    <script>
        const inputs = document.querySelectorAll('.verification-code input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length > 0 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>
</body>

</html>

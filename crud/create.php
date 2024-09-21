<?php
session_start();
require_once '../connect/dbcon.php';

if (isset($_POST["register"])) {
    $UserName = $_POST['regUserName'];
    $PassWord = $_POST['regPassWord'];
    $FullName = $_POST['regFullName'];

    // Validate if the password is at least 8 characters
    if (strlen($PassWord) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
        header("Location: create.php");
        exit();
    }

    // Hash the password for secure storage
    $hashedPassWord = password_hash($PassWord, PASSWORD_DEFAULT);

    // Default profile image path
    $defaultImage = '../uploads/default.jpg';

    try {
        // Insert the user data into the database
        $pdoQuery = "INSERT INTO user (UserName, PassWord, FullName, image) VALUES (:UserName, :PassWord, :FullName, :image)";
        $pdoResult = $pdoConnect->prepare($pdoQuery);

        $pdoResult->execute([
            ":UserName" => $UserName,
            ":PassWord" => $hashedPassWord,
            ":FullName" => $FullName,
            ":image" => $defaultImage
        ]);

        // Success message and redirect to login page
        $_SESSION['success'] = "Successfully registered!";
        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        // Handle any database errors
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: register.php");
        exit();
    }
}
?>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']); // Clear the message after displaying
}

if (isset($_SESSION['success'])) {
    echo "<p style='color: green'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']); // Clear the message after displaying
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../style/signup.css">
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
    <style>
        /* Optional: Basic styles for the form */
        .form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input_box {
            position: relative;
            margin-bottom: 15px;
        }

        .input_box input {
            width: 100%;
            padding: 10px;
            padding-left: 40px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .input_box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background: #0056b3;
        }

        .login_signup {
            margin-top: 10px;
            text-align: center;
        }

        .login_signup a {
            color: #007bff;
            text-decoration: none;
        }

        .login_signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Signup Form -->
        <div class="form signup_form">
            <form method="post" autocomplete="off" action="create.php">
                <h2>Signup</h2>

                <!-- Email input box -->
                <div class="input_box">
                    <input type="email" name="regUserName" placeholder="Enter your email" required />
                    <i class="uil uil-envelope-alt email"></i>
                </div>

                <!-- Password input box -->
                <div class="input_box">
                    <input type="password" name="regPassWord" placeholder="Create password" minlength="8" required />
                    <i class="uil uil-lock password"></i>
                    <i class="uil uil-eye-slash pw_hide"></i>
                </div>

                <!-- Full Name input box -->
                <div class="input_box">
                    <input type="text" name="regFullName" placeholder="Fullname" required />
                    <i class="uil uil-user user"></i>
                </div>

                <!-- Signup button -->
                <button class="button" type="submit" name="register" value="Register">Signup Now</button>

                <!-- Link to login page -->
                <div class="login_signup">Already have an account? <a href="admin.php" id="login">Login</a></div>
            </form>
        </div>
    </div>
    <script>
        // Optional: JavaScript to toggle password visibility
        document.querySelector('.pw_hide').addEventListener('click', function () {
            var passwordField = document.querySelector('input[name="regPassWord"]');
            var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('uil-eye');
            this.classList.toggle('uil-eye-slash');
        });
    </script>
</body>

</html>
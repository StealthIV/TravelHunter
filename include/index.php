<?php

session_start();
require_once '../connect/dbcon.php'; // Database connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/src/Exception.php';
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';

// Check if the user is already logged in
if (isset($_SESSION["UserName"])) {
  header("Location: home.php");
  exit();
}

// Registration
if (isset($_POST["register"])) {
  $UserName = $_POST['regUserName'];
  $PassWord = $_POST['regPassWord'];
  $FullName = $_POST['regFullName'];

  // Check if password is at least 8 characters
  if (strlen($PassWord) < 8) {
    $_SESSION['error'] = "Password must be at least 8 characters long.";
    header("Location: register.php");
    exit();
  }

  // Generate a 6-character verification code
  $verificationCode = strtoupper(substr(md5(rand()), 0, 6)); // 6-character alphanumeric code

  // Store user data in an array (temporary storage)
  $userData = [
    'UserName' => $UserName,
    'PassWord' => $PassWord,
    'FullName' => $FullName,
    'verification_code' => $verificationCode,
    'hashedPassWord' => password_hash($PassWord, PASSWORD_DEFAULT),
    'defaultImage' => '../uploads/default.jpg', // Default profile image
    'UserRole' => 'user', // Setting default role to 'user'
  ];

  // Proceed with sending the verification email first
  $mail = new PHPMailer(true);  // Create PHPMailer instance

  try {
    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Set SMTP server
    $mail->SMTPAuth = true;  // Enable SMTP authentication
    $mail->Username = 'huntertravel150@gmail.com'; // Your email address
    $mail->Password = 'igvxyavzuysqskby'; // Your SMTP password or app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;  // SMTP port

    $mail->setFrom('cferdinand500@gmail.com', 'Travel Hunter');
    $mail->addAddress($userData['UserName']);  // Send verification email to the user

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Please Verify Your Email Address';
    $mail->Body = "Thank you for registering! To verify your account, please use the following verification code:<br><br>
                      <strong>$verificationCode</strong><br><br>
                      Enter this code in the verification form on the website to complete your registration.";

    $mail->send();

    // Send verification email successfully, now you can proceed to insert user data (or store it as needed)
    // Here, insert user data into the database
    try {
      $pdoQuery = "INSERT INTO user (UserName, PassWord, FullName, image, verification_code, UserRole) 
                   VALUES (:UserName, :PassWord, :FullName, :image, :verification_code, :UserRole)";
      $pdoResult = $pdoConnect->prepare($pdoQuery);
      $pdoResult->execute([
        ":UserName" => $userData['UserName'],
        ":PassWord" => $userData['hashedPassWord'],
        ":FullName" => $userData['FullName'],
        ":image" => $userData['defaultImage'],
        ":verification_code" => $userData['verification_code'],
        ":UserRole" => $userData['UserRole'], // Insert the user role
      ]);

      $_SESSION['success'] = "Successfully registered! Please check your email for the verification code.";
      header("Location: verify.php");
      exit();

    } catch (PDOException $e) {
      $_SESSION['error'] = "Error: Could not save user data. Please try again.";
      header("Location: register.php");
      exit();
    }

  } catch (Exception $e) {
    $_SESSION['error'] = "Error: Could not send verification email. Please try again.";
    header("Location: index.php");
    exit();
  }
}



// Login
if (isset($_POST["login"])) {
  $username = trim($_POST["UserName"]);
  $password = trim($_POST["PassWord"]);

  if (empty($username) || empty($password)) {
    $_SESSION['error'] = "All fields are required!";
    header("Location: index.php");
    exit();
  } else {
    try {
      $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
      $pdoResult = $pdoConnect->prepare($pdoQuery);
      $pdoResult->execute(['UserName' => $username]);
      $user = $pdoResult->fetch();

      if ($user && password_verify($password, $user["PassWord"])) {
        // Store user information in session
        $_SESSION["UserName"] = $user["UserName"];
        $_SESSION["UserRole"] = $user["UserRole"];
        $_SESSION["id"] = $user["id"];

        // If the user is an admin or manager, send a verification code
        if ($_SESSION["UserRole"] == "admin" || $_SESSION["UserRole"] == "manager") {
          // Generate a verification code
          $verificationCode = strtoupper(substr(md5(rand()), 0, 6)); // 6-character code

          // Store the verification code in the session
          $_SESSION['verification_code'] = $verificationCode;

          // Send verification code via email
          $mail = new PHPMailer(true);
          try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'huntertravel150@gmail.com'; // Your email address
            $mail->Password = 'igvxyavzuysqskby'; // Your SMTP password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('cferdinand500@gmail.com', 'Travel Hunter');
            $mail->addAddress($user['UserName']);  // Send to the user's email

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Login Verification Code';
            $mail->Body = "You are logging in as an admin or manager. Please use the following verification code to complete your login process:<br><br>
                          <strong>$verificationCode</strong><br><br>
                          Enter this code in the verification form on the website.";

            $mail->send();

            // Redirect to the verification page
            header("Location: verify_code.php");
            exit();
          } catch (Exception $e) {
            $_SESSION['error'] = "Error: Could not send verification email. Please try again.";
            header("Location: index.php");
            exit();
          }
        } else {
          // Normal user login, redirect directly to their homepage
          $_SESSION['success'] = "Login successful!";
          header("Location: home.php");
          exit();
        }
      } else {
        $_SESSION['error'] = "Invalid username or password";
        header("Location: index.php");
        exit();
      }
    } catch (PDOException $error) {
      $_SESSION['error'] = "Error: " . $error->getMessage();
      header("Location: index.php");
      exit();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Hunter</title>
  <link rel="stylesheet" href="../style/style1.css" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <style>
    /* CSS to toggle visibility of forms */
    .form_container .login_form,
    .form_container .signup_form {
      display: none;
    }

    .form_container .login_form.active,
    .form_container .signup_form.active {
      display: block;
    }
  </style>
</head>

<body>
  <!-- Header with Login and Signup Buttons -->
  <header class="header">
  <img class="logos" src="../img/logo.png" alt="" srcset="">
    <nav class="nav">
     
      <a href="#" class="nav_logo">Travel Hunter</a>
      <button class="button" id="login-btn">Login</button>
      <button class="button" id="signup-btn">Signup</button>
    </nav>
  </header>

  <!-- Main Section for Login and Signup Forms -->
  <section class="home">
    <div class="form_container">
      <i class="uil uil-times form_close"></i>

      <!-- Login Form -->
      <div class="form login_form">
        <form method="POST">
          <h2>Login</h2>
          <div class="input_box">
            <input type="email" name="UserName" placeholder="Enter your username" required />
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" name="PassWord" placeholder="Enter your password" required />
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <div class="option_field">
            <span class="checkbox">
              <input type="checkbox" id="check" />
              <label for="check">Remember me</label>
            </span>
            <a href="#" class="forgot_pw">Forgot password?</a>
          </div>
          <button class="button" type="submit" name="login" value="Login">Login Now</button>
          <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
        </form>
      </div>

      <!-- Signup Form -->
      <div class="form signup_form">
        <form method="post" autocomplete="off">
          <h2>Signup</h2>
          <div class="input_box">
            <input type="email" name="regUserName" placeholder="Enter your email" required />
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" name="regPassWord" placeholder="Create password" minlength="8" required />
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <div class="input_box">
            <input type="text" name="regFullName" placeholder="Fullname" required />
            <i class="uil uil-user username"></i>
          </div>
          <button class="button" type="submit" name="register" value="Register">Signup Now</button>
          <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
        </form>
      </div>
    </div>


    <script>
      // JavaScript to handle form toggling
      const loginBtn = document.querySelector("#login-btn"),
        signupBtn = document.querySelector("#signup-btn"),
        home = document.querySelector(".home"),
        formContainer = document.querySelector(".form_container"),
        formCloseBtn = document.querySelector(".form_close"),
        pwShowHide = document.querySelectorAll(".pw_hide"),
        loginForm = document.querySelector(".login_form"),
        signupForm = document.querySelector(".signup_form");

      // Open login form when Login button is clicked
      loginBtn.addEventListener("click", () => {
        home.classList.add("show");
        signupForm.classList.remove("active"); // Hide signup form
        loginForm.classList.add("active");     // Show login form
      });

      // Open signup form when Signup button is clicked
      signupBtn.addEventListener("click", () => {
        home.classList.add("show");
        loginForm.classList.remove("active");  // Hide login form
        signupForm.classList.add("active");    // Show signup form
      });

      // Close form container when close button is clicked
      formCloseBtn.addEventListener("click", () => {
        home.classList.remove("show");
        loginForm.classList.remove("active");
        signupForm.classList.remove("active");
      });

      // Toggle password visibility
      pwShowHide.forEach((icon) => {
        icon.addEventListener("click", () => {
          let getPwInput = icon.parentElement.querySelector("input");
          if (getPwInput.type === "password") {
            getPwInput.type = "text";
            icon.classList.replace("uil-eye-slash", "uil-eye");
          } else {
            getPwInput.type = "password";
            icon.classList.replace("uil-eye", "uil-eye-slash");
          }
        });
      });
    </script>


    <div class="slider">
      <div class="list">

        <div class="item">
          <img src="../img/el.jpg" alt="">

          <div class="content">
            <div class="title">El Nido</div>
            <div class="type">Palawan</div>
            <div class="description">
              Your Gateway to Untouched Beauty

            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/b11.jpg" alt="">

          <div class="content">
            <div class="title">Boracay</div>
            <div class="type">Aklan</div>
            <div class="description">
              Dive into Crystal Clear Waters
            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/21.jpg" alt="">

          <div class="content">
            <div class="title">Silanguin Cove</div>
            <div class="type">Zambales</div>
            <div class="description">
              Find Peace in the Pristine Shores of Silanguin Cove

            </div>

          </div>
        </div>
        <div class="item">
          <img src="../img/mtp.jpg" alt="">

          <div class="content">
            <div class="title">Mt. Pinatubo</div>
            <div class="type">Pampanga</div>
            <div class="description">
              Experience the Thrill of Mt. Pinatubo’s Epic Trail

            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/batangas.jpg" alt="">

          <div class="content">
            <div class="title">Taal Volcano</div>
            <div class="type">Batangas</div>
            <div class="description">
              Witness the Awe of Taal Volcano

            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/bataan.jpg" alt="">

          <div class="content">
            <div class="title">White Peak</div>
            <div class="type">Bataan</div>
            <div class="description">
              Conquer the Summit at White Peak
            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/cebu.jpg" alt="">

          <div class="content">
            <div class="title">Kawasan Falls</div>
            <div class="type">Cebu</div>
            <div class="description">
              Chase the Cascades at Kawasan Falls

            </div>

          </div>
        </div>

      </div>


      <div class="thumbnail">

        <div class="item">
          <img src="../img/el.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/b11.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/21.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/mtp.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/batangas.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/bataan.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/cebu.jpg" alt="">
        </div>

      </div>


      <div class="nextPrevArrows">
        <button class="prev">
          < </button>
            <button class="next"> > </button>
      </div>


    </div>

  </Section>
  <script src="../js/app1.js"></script>
  <script src="../js/script1.js"></script>
  <script>
    setTimeout(() => {
      const notification = document.querySelector('.notification');
      if (notification) {
        notification.classList.add('hide');
      }
    }, 3000);

    const passwordInput = document.querySelector('input[name="regPassWord"]');

    passwordInput.addEventListener('input', function () {
      if (passwordInput.value.length < 8) {
        passwordInput.setCustomValidity("Password must be at least 8 characters long.");
      } else {
        passwordInput.setCustomValidity(""); // Reset the message when valid
      }
    });
  </script>


</body>

</html>
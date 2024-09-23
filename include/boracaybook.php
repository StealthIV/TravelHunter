<?php
session_start();
if (!isset($_SESSION["UserName"])) {
   header("location: index.php");
   exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
   $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
   $pdoResult = $pdoConnect->prepare($pdoQuery);
   $pdoResult->execute(['UserName' => $UserName]);
   $user = $pdoResult->fetch();
   $profile_image = $user['image']; // Assuming this is the URL to the profile image
} catch (PDOException $error) {
   echo $error->getMessage() . '';
   exit;
}

// Check if the user is logged in
if (isset($_SESSION['id'])) {
   $user_id = $_SESSION['id'];

   try {
      // Fetch the user's details from the database using user_id
      $stmt = $pdoConnect->prepare("SELECT UserName, FullName, PassWord, image FROM user WHERE id = :user_id");
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
         // Extract user details
         $email = $user['UserName'];
         $full_name = $user['FullName'];
         $password = $user['PassWord'];
         $profile_image = !empty($user['image']) ? $user['image'] : 'img/default_profile.jpg'; // Fallback to default image
      } else {
         // Handle the case where user details are not found
         echo "User details not found.";
         exit();
      }
   } catch (PDOException $e) {
      // Handle database connection error or query failure
      echo "Error: " . $e->getMessage();
      exit();
   }
} else {
   // Redirect to the login page if the user is not logged in
   header("Location: login.php");
   exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Travel Hunter</title>
   <link rel="stylesheet" href="../style/boracaybook.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
   <div id="error-message" style="display:none; color:red; margin-bottom:10px;"></div>
</head>

<body>

   <?php require_once "nav.php"; ?>

   <section class="overlay"></section>

   <section class="main">
      <div class="container">
         <header>Booking Form</header>
         <div class="progress-bar">
            <div class="step active">
               <p class="active">Personal</p>
               <div class="bullet active"><span>1</span></div>
               <div class="check active">✔</div>
            </div>
            <div class="step">
               <p>Booking</p>
               <div class="bullet"><span>2</span></div>
               <div class="check">✔</div>
            </div>
            <div class="step">
               <p>Payment</p>
               <div class="bullet"><span>3</span></div>
               <div class="check">✔</div>
            </div>
            <div class="step">
               <p>Submit</p>
               <div class="bullet"><span>4</span></div>
               <div class="check">✔</div>
            </div>
         </div>

         <div class="form-outer">
            <form id="bookingForm" action="user.php" method="post">
               <div class="page slide-page">
                  <div class="title">Basic Info:</div>
                  <div class="field">
                     <div class="label">Full Name</div><input type="text" id="name" name="name" required>
                     <span id="name-error" style="color:red; display:none;">Full Name is required</span>
                  </div>
                  <div class="field">
                     <div class="label">Email Address</div><input type="email" id="email" name="email" required>
                     <span id="email-error" style="color:red; display:none;">Valid email is required</span>
                  </div>
                  <div class="field">
                     <div class="label">Phone Number</div><input type="text" id="phone" name="phone" required>
                     <span id="phone-error" style="color:red; display:none;">Valid phone number is required</span>
                  </div>
                  <div class="field">
                     <button class="firstNext next" type="button" onclick="validateStep1()">Next</button>
                  </div>
               </div>

               <div class="page">
                  <div class="title">Booking Info:</div>
                  <div class="field">
                     <div class="label">Choose Package</div>
                     <select id="package" name="package" required>
                        <option hidden>Choose Package</option>
                        <option value="Platinum">Platinum</option>
                        <option value="Gold">Gold</option>
                        <option value="Silver">Silver</option>
                        <option value="Bronze">Bronze</option>
                     </select>
                  </div>
                  <div class="field">
                     <div class="label">Booking Date</div><input type="date" id="checkin" name="checkin" required>
                  </div>
                  <div class="field">
                     <div class="label">Number of Guests</div><input type="number" id="guests" name="guests" min="1"
                        max="50" required>
                  </div>
                  <div class="field">
                     <div class="label">Number of Days</div><input type="number" id="days" name="days" required>
                  </div>
                  <div class="field btns"><button class="prev-1 prev">Previous</button><button class="next-1 next"
                        type="button" onclick="validateStep2()">Next</button></div>
               </div>

               <div class="page">
                  <div class="title">Payment:</div>
                  <div class="field">
                     <div class="label">Mode of Payment</div>
                     <select id="payment" name="payment" required>
                        <option hidden>Payment Method</option>
                        <option>Gcash</option>
                        <option>Maya</option>
                        <option>Paypal</option>
                     </select>
                  </div>
                  <div class="field">
                     <div class="label">Down Payment</div><input type="number" id="amount" name="amount" step="0.01"
                        required>
                  </div>
                  <div class="field">
                     <div class="label">Reference Number</div><input type="text" id="Reference" name="Reference"
                        required>
                  </div>
                  <div class="field btns"><button class="prev-2 prev">Previous</button><button class="next-2 next"
                        type="button" onclick="validateStep3()">Next</button></div>
               </div>

               <div class="page">
                  <div class="title">Confirm Booking:</div>
                  <p>Please confirm your details before submitting.</p>
                  <div class="field btns"><button class="prev-3 prev">Previous</button><button class="submit"
                        type="submit">Submit</button></div>
               </div>
            </form>
         </div>
      </div>

      <script src="../js/home.js"></script>
      <script src="../js/language.js"></script>
      <script src="../js/socmed.js"></script>
      <script>
       
      </script>
   </section>
</body>

</html>
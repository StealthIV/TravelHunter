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
                     <div class="label">Email Address</div>
                     <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                        readonly required>
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
            
                     <select id="package" name="package">
                <option value="">-- Select a Package --</option>
                <option value="1000">Basic Package - &#8369;1000</option>
                <option value="1500">Standard Package - &#8369;1500</option>
                <option value="2000">Premium Package - &#8369;2000</option>
            </select>
                  </div>

               


                  <div class="field">
                     <div class="label">Booking Date</div><input type="date" id="checkin" name="checkin" required>
                  </div>
                  <div class="field">
                     <div class="label"  for="quantity">Number of Guests</div> 
                       <input type="number" id="guests" name="guests" value="1" min="1" required>

                  </div>
                  <div class="field">
                     <div class="label">Number of Days</div><input type="number" id="days" name="days" required>
                  </div>
                  <div class="field btns">
    <button class="prev-1 prev" type="button" onclick="prevPage()">Previous</button>
    <button class="next-1 next" type="button" onclick="validateStep2()">Next</button>
</div>

               </div>

               <div class="page">
                  <div class="title">Payment:</div>
                  <h1>Gcash account: 09663174570</h1>
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
                     <div class="label" for="downpayment">Downpayment Amount (30%):</div>
                     <input type="text" id="amount" name="amount"  value="&#8369;0" readonly>
                  </div>
                  <div class="field">
                     <div class="label" for="balance">Balance Amount:</div>
                     <input type="text" id="balance" name="balance" value="&#8369;0" readonly>
                  </div>
                  
                  <div class="field">
                     <div class="label">Reference Number</div><input type="text" id="Reference" name="Reference"
                        required>
                  </div>
                  <div class="field btns">
                     <button class="prev-1 prev" type="button" onclick="prevPage()">Previous</button>
                     <button class="next-1 next" type="button" onclick="validateStep2()">Next</button>
                  </div>

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

      <script src="../js/payselect.js"></script>
      <script src="../js/home.js"></script>
      <script src="../js/language.js"></script>
      <script>
         let currentPage = 0;

         function validateStep1() {
            let isValid = true;

            // Full Name validation
            const name = document.getElementById('name').value;
            if (name.trim() === "") {
               document.getElementById('name-error').style.display = 'block';
               isValid = false;
            } else {
               document.getElementById('name-error').style.display = 'none';
            }

            // Email validation
            const email = document.getElementById('email').value;
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
               document.getElementById('email-error').style.display = 'block';
               isValid = false;
            } else {
               document.getElementById('email-error').style.display = 'none';
            }

            // Phone number validation
            const phone = document.getElementById('phone').value;
            const phonePattern = /^[0-9]{10,12}$/;
            if (!phone.match(phonePattern)) {
               document.getElementById('phone-error').style.display = 'block';
               isValid = false;
            } else {
               document.getElementById('phone-error').style.display = 'none';
            }

            if (isValid) {
               nextPage();
            }
         }

         function validateStep2() {
            let isValid = true;
            const packageSelect = document.getElementById('package');
            const checkinDate = document.getElementById('checkin').value;
            const guests = document.getElementById('guests').value;
            const days = document.getElementById('days').value;

            if (packageSelect.value === "") {
               alert("Package selection is required.");
               isValid = false;
            }

            if (checkinDate === "") {
               alert("Check-in date is required.");
               isValid = false;
            }

            if (guests <= 0) {
               alert("Number of guests must be greater than zero.");
               isValid = false;
            }

            if (days <= 0) {
               alert("Number of days must be greater than zero.");
               isValid = false;
            }

            if (isValid) {
               nextPage();
            }
         }

         function validateStep3() {
            let isValid = true;
            const paymentSelect = document.getElementById('payment');
            const amount = document.getElementById('amount').value;
            const reference = document.getElementById('Reference').value;

            if (paymentSelect.value === "") {
               alert("Payment method is required.");
               isValid = false;
            }

            if (amount <= 0) {
               alert("Down payment must be greater than zero.");
               isValid = false;
            }

            if (reference.trim() === "") {
               alert("Reference number is required.");
               isValid = false;
            }

            if (isValid) {
               nextPage();
            }
         }

         function nextPage() {
            const pages = document.querySelectorAll('.page');
            const steps = document.querySelectorAll('.progress-bar .step');

            // Hide the current page
            pages[currentPage].style.display = 'none';

            // Update the step classes
            steps[currentPage].classList.remove('active');
            steps[currentPage].querySelector('.bullet').classList.remove('active');
            steps[currentPage].querySelector('.check').classList.add('active');

            currentPage++;

            // Ensure we do not exceed the number of pages
            if (currentPage < pages.length) {
               pages[currentPage].style.display = 'block';
               steps[currentPage].classList.add('active');
               steps[currentPage].querySelector('.bullet').classList.add('active');
               steps[currentPage].querySelector('p').classList.add('active');
            }
         }

         function prevPage() {
            const pages = document.querySelectorAll('.page');
            const steps = document.querySelectorAll('.progress-bar .step');

            // Hide the current page
            pages[currentPage].style.display = 'none';

            // Update the step classes
            steps[currentPage].classList.remove('active');
            steps[currentPage].querySelector('.bullet').classList.remove('active');
            steps[currentPage].querySelector('.check').classList.remove('active');

            currentPage--;

            // Show the previous page
            pages[currentPage].style.display = 'block';
            steps[currentPage].classList.add('active');
            steps[currentPage].querySelector('.bullet').classList.add('active');
            steps[currentPage].querySelector('p').classList.add('active');
         }

         // Initial state
         const pages = document.querySelectorAll('.page');
         pages.forEach((page, index) => {
            page.style.display = index === currentPage ? 'block' : 'none';
         });

      </script>
   </section>
</body>

</html>
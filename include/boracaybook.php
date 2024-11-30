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
                     <div class="label">Full Name</div>
                     <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($full_name); ?>" readonly
                        required>
                     <span id="name-error" style="color:red; display:none;">Full Name is required</span>
                  </div>
                  <div class="field">
                     <div class="label">Email Address</div>
                     <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                        readonly required>
                     <span id="email-error" style="color:red; display:none;">Valid email is required</span>
                  </div>
                  <div class="field">
   <div class="label">Phone Number</div>
   <input type="text" id="phone" name="phone" required>
   <span id="phone-error" style="color:red; display:none;">Valid phone number is required</span>
</div>

<script>
   document.getElementById("phone").addEventListener("input", function(event) {
      var phoneInput = event.target;
      var value = phoneInput.value;
      var errorElement = document.getElementById("phone-error");

      // Remove non-numeric characters from the input
      phoneInput.value = value.replace(/\D/g, '');

      // Check if the input is empty or invalid
      if (phoneInput.value === "" || phoneInput.value.length < 10) {
         errorElement.style.display = "inline"; // Show error
      } else {
         errorElement.style.display = "none"; // Hide error
      }
   });
</script>
                  <div class="field">
                     <button class="firstNext next" type="button" onclick="validateStep1()">Next</button>
                  </div>
               </div>

               <div class="page">
                  <div class="title">Booking Info:</div>
                  <div class="field">
                     <div class="label">Choose Package</div>
                     <select id="package" name="package" onchange="calculatePayment()">
                        <option value="">-- Select a Package --</option>
                        <option value="Bronze Package - ₱6,999">Bronze Package - &#8369;6,999</option>
                        <option value="Silver Package - ₱7,999">Silver Package - &#8369;7,999</option>
                        <option value="Gold Package - ₱8,999">Gold Package - &#8369;8,999</option>
                        <option value="Platinum Package - ₱10,999">Platinum Package - &#8369;10,999</option>
                     </select>
                  </div>
                  <div class="field">
                    <div class="label">Booking Date</div>
                      <input type="date" id="checkin" name="checkin" required min="">
                    </div>

                  <script>
  // Set the minimum date to today's date
                    const checkinInput = document.getElementById('checkin');
                     const today = new Date().toISOString().split('T')[0];
                     checkinInput.setAttribute('min', today);
                      </script>
                  <div class="field">
                     <div class="label" for="quantity">Number of Guests</div>
                     <input type="number" id="guests" name="guests" value="1" min="1" required>
                  </div>
                  <div class="field">
                     <div class="label">Number of Days</div>
                     <input type="number" id="days" name="days" required>
                  </div>
                  <div class="field btns">
                     <button class="prev-1 prev" type="button" onclick="prevPage()">Previous</button>
                     <button class="next-1 next" type="button" onclick="validateStep2()">Next</button>
                  </div>
               </div>

               <div class="page">
                 

        <!-- QR Code -->
        <div id="qr-code-container" style="margin-top: 20px; display: none;">
            <h3>Scan QR Code to Pay</h3>
            <img id="qr-code" src="" alt="QR Code" style="width: 200px; cursor: pointer;" onclick="zoomQRCode()">
        </div>
                  <div class="field">
                     <div class="label">Mode of Payment</div>
                     <select id="payment" name="payment" required>
                        <option hidden>Payment Method</option>
                        <option value="gcash">GCash (09663174570)</option>
                        <option value="paymaya">PayMaya (09663174570)</option>
                        <option value="paypal">PayPal (09663174570)</option>
                     </select>
                  </div>
                  <div class="field">
                     <div class="label" for="downpayment">Downpayment Amount (30%):</div>
                     <input type="text" id="downpayment" name="downpayment" value="₱0" readonly>
                  </div>
                  <div class="field">
                     <div class="label" for="balance">Balance Amount:</div>
                     <input type="text" id="balance" name="balance" value="₱0" readonly>
                  </div>
                  <div class="field">
   <div class="label">Reference Number</div>
   <input type="text" id="Reference" name="Reference" required>
   <span id="reference-error" style="color:red; display:none;">Valid reference number is required</span>
</div>


<style>
    /* General container styling */
    #qr-code-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #f8f8f8;
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        max-width: 200px;
        margin: 20px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* QR Code Image Styling */
    #qr-code {
        width: 150px;
        height: 150px;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
        border: 2px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
    }

    #qr-code:hover {
        transform: scale(1.1);
        border-color: #007bff;
    }

    /* Title above the QR code */
    #qr-code-container h3 {
        margin: 0;
        padding: 0;
        font-size: 18px;
        color: #333;
        text-align: center;
    }
</style>











<script>
   document.getElementById("Reference").addEventListener("input", function(event) {
      var referenceInput = event.target;
      var value = referenceInput.value;
      var errorElement = document.getElementById("reference-error");

      // Remove non-numeric characters from the input
      referenceInput.value = value.replace(/\D/g, '');

      // Check if the input is empty or invalid (example: length less than 6 digits)
      if (referenceInput.value === "" || referenceInput.value.length < 6) {
         errorElement.style.display = "inline"; // Show error
      } else {
         errorElement.style.display = "none"; // Hide error
      }
   });
</script>

                  <div class="field btns">
                     <button class="prev-1 prev" type="button" onclick="prevPage()">Previous</button>
                     <button class="next-1 next" type="button" onclick="validateStep2()">Next</button>
                  </div>
               </div>

               <div class="page">
                  <div class="title">Confirm Booking:</div>
                  <p>Please confirm your details before submitting.</p>
                  <div class="field btns">
                     <button class="prev-3 prev">Previous</button>
                     <button class="submit" type="submit">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>

      <script src="../js/payselect.js"></script>
      <script src="../js/home.js"></script>
      <script src="../js/language.js"></script>
      <script>
    function calculatePayment() {
        // Get the selected package
        const packageSelect = document.getElementById("package");
        const selectedPackage = packageSelect.value;

        // Extract the price from the selected option
        const priceMatch = selectedPackage.match(/₱([\d,]+)/);
        const price = priceMatch ? parseFloat(priceMatch[1].replace(/,/g, '')) : 0;

        // Get the number of guests and days
        const guests = parseInt(document.getElementById("guests").value) || 0;
        const days = parseInt(document.getElementById("days").value) || 0;

        // Calculate additional charge (₱500 per day)
        const additionalCharge = 500 * days;

        // Calculate total price
        const totalPrice = (price * guests * days) + additionalCharge;

        // Calculate downpayment and balance
        const downpayment = totalPrice * 0.3; // 30% of the total price
        const balance = totalPrice - downpayment; // Total minus downpayment

        // Update the downpayment and balance fields
        document.getElementById("downpayment").value = "₱" + downpayment.toFixed(2);
        document.getElementById("balance").value = "₱" + balance.toFixed(2);
    }

    // Attach event listeners to inputs
    document.getElementById("package").addEventListener("change", calculatePayment);
    document.getElementById("guests").addEventListener("input", calculatePayment);
    document.getElementById("days").addEventListener("input", calculatePayment);

    function updateQRCode() {
        const paymentMethod = document.getElementById("payment").value;
        const qrCodeContainer = document.getElementById("qr-code-container");
        const qrCodeImage = document.getElementById("qr-code");

        // Set QR Code image based on selected payment method
        switch (paymentMethod) {
            case "gcash":
                qrCodeImage.src = "../img/gcash.jpg"; // Replace with actual GCash QR code image path
                break;
            case "paymaya":
                qrCodeImage.src = "../img/maya.jpg"; // Replace with actual PayMaya QR code image path
                break;
            case "paypal":
                qrCodeImage.src = "path/to/paypal-qr-code.png"; // Replace with actual PayPal QR code image path
                break;
        }

        // Show QR Code container
        qrCodeContainer.style.display = "block";
    }

    function zoomQRCode() {
        const qrCodeImage = document.getElementById("qr-code");
        const zoomWindow = window.open("", "QR Code", "width=500,height=500");
        zoomWindow.document.write(`<img src="${qrCodeImage.src}" alt="Zoomed QR Code" style="width: 100%;">`);
    }

    // Attach event listeners
    document.getElementById("package").addEventListener("change", calculatePayment);
    document.getElementById("guests").addEventListener("input", calculatePayment);
    document.getElementById("days").addEventListener("input", calculatePayment);
    document.getElementById("payment").addEventListener("change", updateQRCode);
</script>

   </section>
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
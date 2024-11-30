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
   $user = $pdoResult->fetch(PDO::FETCH_ASSOC);

   if ($user) {
      $profile_image = !empty($user['image']) ? $user['image'] : 'img/default_profile.jpg'; // Fallback to default if image is empty
      $email = $user['UserName'];  // Assuming the email is stored in the UserName field
      $full_name = $user['FullName'];
   } else {
      echo "User not found.";
      exit();
   }
} catch (PDOException $error) {
   echo $error->getMessage();
   exit();
}

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
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
</head>

<body>

   <?php require_once "nav.php"; ?>

   <section class="overlay"></section>

   <section class="main">
      <div class="container">
         <header>Order Form</header>
         <div class="progress-bar">
            <div class="step active">
               <p class="active">Personal</p>
               <div class="bullet active"><span>1</span></div>
               <div class="check active">✔</div>
            </div>
            <div class="step">
               <p>Order</p>
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
            <form id="bookingForm" action="boracaymarket1.php" method="post">
               <div class="page slide-page">
                  <div class="title">Basic Info:</div>
                  <div class="field">
                     <div class="label">Full Name</div><input type="text" id="name" name="name" required>
                     <span id="name-error" style="color:red; display:none;">Full Name is required</span>
                  </div>
                  <div class="field">
                     <div class="label">Email Address</div>
                     <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly required>
                     <span id="email-error" style="color:red; display:none;">Valid email is required</span>
                  </div>
                  <div class="field">
                     <div class="label">Phone Number</div><input type="number" id="phone" name="phone" required>
                     <span id="phone-error" style="color:red; display:none;">Valid phone number is required</span>
                  </div>
                  <div class="field">
                     <button class="firstNext next" type="button" onclick="validateStep1()">Next</button>
                  </div>
               </div>

               <!-- Order Info Step -->
               <div class="page">
                  <div class="title">Order Info:</div>
                  <div class="field">
                     <div class="label">Choose Item</div>
                     <select id="item" name="item">
                        <option value="">-- Select a Item --</option>
                        <option value="Shell Keychains - ₱500">Shell Keychains - ₱500</option>
                        <option value="Beaded Bracelets - ₱300">Beaded Bracelets - ₱300</option>
                        <option value="Handwoven Bag - ₱500">Handwoven Bag - ₱500</option>
                        <option value="White Beach Sarong - ₱300">White Beach Sarong - ₱300</option>
                        <option value="Bamboo Craft Wooden Figure - ₱300">Bamboo Craft Wooden Figure - ₱300</option>
                        <option value="Boracay Island Tee - ₱600">Boracay Island Tee - ₱600</option>
                     </select>
                  </div>
                  <div class="field">
                     <div class="label">Order Date</div><input type="date" id="checkin" name="checkin" required>
                  </div>

                  <script>
  // Set the minimum date to today's date
                    const checkinInput = document.getElementById('checkin');
                     const today = new Date().toISOString().split('T')[0];
                     checkinInput.setAttribute('min', today);
                      </script>
                  <div class="field">
                     <div class="label" for="quantity">Quantity of Item</div> 
                       <input type="number" id="quantity" name="quantity" value="1" min="1" required>
                  </div>
                  <div class="field">
                     <div class="label">Delivery Address</div><input type="text" id="address" name="address" required>
                  </div>
                  <div class="field btns">
                     <button class="prev-1 prev" type="button" onclick="prevPage()">Previous</button>
                     <button class="next-1 next" type="button" onclick="validateStep2()">Next</button>
                  </div>
               </div>

               <!-- Payment Step -->
               <div class="page">
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
                  </div>
                  <div class="field btns">
                     <button class="prev-1 prev" type="button" onclick="prevPage()">Previous</button>
                     <button class="next-1 next" type="button" onclick="validateStep3()">Next</button>
                  </div>
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

               <!-- Confirmation Step -->
               <div class="page">
                  <div class="title">Confirm Order Item:</div>
                  <p>Please confirm your details before submitting.</p>
                  <div class="field btns">
                     <button class="prev-3 prev">Previous</button>
                     <button class="submit" type="submit">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>



      <script>
         function calculatePayment() {
    // Get the selected item
    const itemSelect = document.getElementById("item");
    const selectedItem = itemSelect.value;

    // Extract the price from the selected option
    const priceMatch = selectedItem.match(/₱([\d,]+)/);
    const price = priceMatch ? parseFloat(priceMatch[1].replace(/,/g, '')) : 0;

    // Get the quantity and address
    const quantity = parseInt(document.getElementById("quantity").value) || 0;
    const address = document.getElementById("address").value.trim();

    // Calculate additional charge (₱500 fixed per transaction if address is provided)
    const additionalCharge = address ? 500 : 0;

    // Calculate total price
    const totalPrice = (price * quantity) + additionalCharge;

    // Calculate downpayment and balance
    const downpayment = totalPrice * 0.3; // 30% of the total price
    const balance = totalPrice - downpayment; // Total minus downpayment

    // Update the downpayment and balance fields
    document.getElementById("downpayment").value = "₱" + downpayment.toFixed(2);
    document.getElementById("balance").value = "₱" + balance.toFixed(2);
}

// Attach event listeners to inputs
document.getElementById("item").addEventListener("change", calculatePayment);
document.getElementById("quantity").addEventListener("input", calculatePayment);
document.getElementById("address").addEventListener("input", calculatePayment);

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
            qrCodeImage.src = "../img/maya.png"; // Replace with actual PayMaya QR code image path
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
document.getElementById("item").addEventListener("change", calculatePayment);
document.getElementById("quantity").addEventListener("input", calculatePayment);
document.getElementById("address").addEventListener("input", calculatePayment);
document.getElementById("payment").addEventListener("change", updateQRCode);

      </script>

      <script src="../js/market.js"></script>
      <script src="../js/home.js"></script>
      <script src="../js/language.js"></script>
      <script>
         // JavaScript functions for navigation and validation
         let currentPage = 0;

         function validateStep1() {
            let isValid = true;

            const name = document.getElementById('name').value;
            if (name.trim() === "") {
               document.getElementById('name-error').style.display = 'block';
               isValid = false;
            } else {
               document.getElementById('name-error').style.display = 'none';
            }

            const email = document.getElementById('email').value;
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
               document.getElementById('email-error').style.display = 'block';
               isValid = false;
            } else {
               document.getElementById('email-error').style.display = 'none';
            }

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
            const itemSelect = document.getElementById('item');
            const checkinDate = document.getElementById('checkin').value;
            const quantity = document.getElementById('quantity').value;
            const address = document.getElementById('address').value;

            if (itemSelect.value === "") {
               alert("Item selection is required.");
               isValid = false;
            }

            if (checkinDate === "") {
               alert("Order date is required.");
               isValid = false;
            }

            if (quantity <= 0) {
               alert("Number of quantity must be greater than zero.");
               isValid = false;
            }

            if (address <= 0) {
               alert("Delivery address is required.");
               isValid = false;
            }

            if (isValid) {
               nextPage();
            }
         }

         function validateStep3() {
            let isValid = true;
            const paymentSelect = document.getElementById('payment');
            const downpayment = document.getElementById('downpayment').value;
            const balance = document.getElementById('balance').value;
            const reference = document.getElementById('Reference').value;

            if (paymentSelect.value === "") {
               alert("Payment method is required.");
               isValid = false;
            }

            if (downpayment <= 0) {
               alert("Downpayment must be greater than zero.");
               isValid = false;
            }

            if (balance <= 0) {
               alert("Balance must be greater than zero.");
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

            pages[currentPage].style.display = 'none';
            steps[currentPage].classList.remove('active');
            steps[currentPage].querySelector('.bullet').classList.remove('active');
            steps[currentPage].querySelector('.check').classList.add('active');

            currentPage++;

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

            pages[currentPage].style.display = 'none';
            steps[currentPage].classList.remove('active');
            steps[currentPage].querySelector('.bullet').classList.remove('active');
            steps[currentPage].querySelector('.check').classList.remove('active');

            currentPage--;

            if (currentPage >= 0) {
               pages[currentPage].style.display = 'block';
               steps[currentPage].classList.add('active');
               steps[currentPage].querySelector('.bullet').classList.add('active');
               steps[currentPage].querySelector('p').classList.add('active');
            }
         }

         // Initial setup for page visibility
         const pages = document.querySelectorAll('.page');
         pages.forEach((page, index) => {
            page.style.display = index === currentPage ? 'block' : 'none';
         });

      </script>
   </section>
</body>

</html>

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

?>

<?php
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
    <!-- CSS -->
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
            <header>Request Form</header>
            <div class="progress-bar">
                <div class="step">
                    <p>Personal</p>
                    <div class="bullet"><span>1</span></div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Request</p>
                    <div class="bullet"><span>2</span></div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Booking</p>
                    <div class="bullet"><span>3</span></div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Submit</p>
                    <div class="bullet"><span>4</span></div>
                    <div class="check fas fa-check"></div>
                </div>
            </div>
            <div class="form-outer">
                <form id="bookingForm" action="../include/cancelbook.php" method="POST">
                    <div class="page slide-page">
                        <div class="title">Basic Info:</div>
                        <div class="field">
                            <div class="label">Full Name</div>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="field">
                            <div class="label">Email Address</div>
                            <input type="email" id="email" name="email"
                                value="<?php echo htmlspecialchars($UserName); ?>" required readonly>
                        </div>

                        <div class="field">
                            <div class="label">Phone Number</div>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                        <div class="field">
                            <button class="firstNext next">Next</button>
                        </div>
                    </div>
                    <div class="page">
                        <div class="title">Request Info:</div>
                        <div class="field">
                            <div class="label">Choose Request</div>
                            <select id="Request" name="Request" required>
                                <option hidden>Choose Request</option>
                                <option value="Cancel Book">Cancel Book</option>
                                <option value="Re-booking">Re-booking</option>
                            </select>
                        </div>
                        <div class="field">
                            <div class="label">Reason of Request</div>
                            <input type="text" id="Reason" name="Reason" required>
                        </div>
                        <div class="field btns">
                            <button class="prev-1 prev">Previous</button>
                            <button class="next-1 next">Next</button>
                        </div>
                    </div>
                    <div class="page">
                        <div class="title">Booking Info:</div>
                        <div class="field">
                            <div class="label">Booking Id</div>
                            <input type="number" id="Booking_Id" name="Booking_Id" required>
                        </div>
                        <div class="field">
                            <div class="label">Refund in Cancel Booking</div>
                            <select id="refundmethod" name="refundmethod" required>
                                <option hidden>Refund Method</option>
                                <option value="Gcash">Gcash</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Paymaya">Paymaya</option>
                            </select>
                        </div>
                        <div class="field">
                            <div class="label">Receiver Number</div>
                            <input type="text" id="receivernum" name="receivernum" required>
                        </div>
                        <div class="field">
                            <div class="label">Re-Booking Date</div>
                            <input type="date" id="rebooking" name="rebooking" required>
                        </div>
                        <div class="field btns">
                            <button class="prev-2 prev">Previous</button>
                            <button class="next-2 next">Next</button>
                        </div>
                    </div>
                    <div class="page">
                        <div class="title">Login Details:</div>
                        <div class="field">
                            <div class="label">Username</div>
                            <input type="text" name="username">
                        </div>
                        <div class="field">
                            <div class="label">Password</div>
                            <input type="password" name="password">
                        </div>
                        <div class="field btns">
                            <button class="prev-3 prev">Previous</button>
                            <button class="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            let currentPage = 0;

            function validateStep1() {
                let isValid = true;
                const name = document.getElementById('name').value.trim();
                if (name === "") {
                    alert("Full Name is required.");
                    isValid = false;
                }

                const phone = document.getElementById('phone').value;
                const phonePattern = /^[0-9]{10,12}$/;
                if (!phone.match(phonePattern)) {
                    alert("Valid Phone Number is required (10-12 digits).");
                    isValid = false;
                }

                if (isValid) {
                    nextPage();
                }
            }

            function validateStep2() {
                let isValid = true;
                const requestSelect = document.getElementById('Request');
                if (requestSelect.value === "") {
                    alert("Please choose a request.");
                    isValid = false;
                }

                const reason = document.getElementById('Reason').value.trim();
                if (reason === "") {
                    alert("Reason for the request is required.");
                    isValid = false;
                }

                if (isValid) {
                    nextPage();
                }
            }

            function validateStep3() {
                let isValid = true;
                const bookingId = document.getElementById('Booking_Id').value;
                if (bookingId <= 0) {
                    alert("Valid Booking ID is required.");
                    isValid = false;
                }

                const refundMethodSelect = document.getElementById('refundmethod');
                if (refundMethodSelect.value === "") {
                    alert("Please choose a refund method.");
                    isValid = false;
                }

                const receiverNum = document.getElementById('receivernum').value;
                const receiverNumPattern = /^[0-9]{10,12}$/;
                if (!receiverNum.match(receiverNumPattern)) {
                    alert("Valid Receiver Number is required (10-12 digits).");
                    isValid = false;
                }

                const rebookingDate = document.getElementById('rebooking').value;
                if (rebookingDate === "") {
                    alert("Re-Booking Date is required.");
                    isValid = false;
                }

                if (isValid) {
                    nextPage();
                }
            }

            function validateStep4() {
                let isValid = true;
                const username = document.querySelector('input[name="username"]').value.trim();
                if (username === "") {
                    alert("Username is required.");
                    isValid = false;
                }

                const password = document.querySelector('input[name="password"]').value;
                if (password === "") {
                    alert("Password is required.");
                    isValid = false;
                }

                if (isValid) {
                    document.getElementById('bookingForm').submit();
                }
            }

            function nextPage() {
                const pages = document.querySelectorAll('.page');
                const steps = document.querySelectorAll('.step');

                steps[currentPage].querySelector('.bullet').classList.add('active');
                steps[currentPage].querySelector('.check').classList.add('active');

                pages[currentPage].style.display = 'none';
                currentPage++;
                pages[currentPage].style.display = 'block';
                steps[currentPage].querySelector('p').classList.add('active');
            }

            function previousPage() {
                const pages = document.querySelectorAll('.page');
                const steps = document.querySelectorAll('.step');

                pages[currentPage].style.display = 'none';
                currentPage--;
                pages[currentPage].style.display = 'block';

                steps[currentPage].querySelector('.bullet').classList.remove('active');
                steps[currentPage].querySelector('.check').classList.remove('active');
                steps[currentPage].querySelector('p').classList.remove('active');
            }

            // Initial setup
            const pages = document.querySelectorAll('.page');
            pages.forEach((page, index) => {
                page.style.display = index === currentPage ? 'block' : 'none';
            });

            // Event listeners for buttons
            document.querySelector('.firstNext').addEventListener('click', (e) => {
                e.preventDefault();
                validateStep1();
            });

            document.querySelector('.next-1').addEventListener('click', (e) => {
                e.preventDefault();
                validateStep2();
            });

            document.querySelector('.next-2').addEventListener('click', (e) => {
                e.preventDefault();
                validateStep3();
            });

            document.querySelector('.prev-1').addEventListener('click', (e) => {
                e.preventDefault();
                previousPage();
            });

            document.querySelector('.prev-2').addEventListener('click', (e) => {
                e.preventDefault();
                previousPage();
            });

            document.querySelector('.prev-3').addEventListener('click', (e) => {
                e.preventDefault();
                previousPage();
            });

            document.querySelector('.submit').addEventListener('click', (e) => {
                e.preventDefault();
                validateStep4();
            });



            function nextPage() {
                const pages = document.querySelectorAll('.page');
                const steps = document.querySelectorAll('.step');

                // Mark the current page as completed
                steps[currentPage].querySelector('.bullet').classList.add('active');
                steps[currentPage].querySelector('.check').classList.add('active');

                // Hide the current page and show the next
                pages[currentPage].style.display = 'none';
                currentPage++;
                pages[currentPage].style.display = 'block';

                // Update the step's text color
                steps[currentPage].querySelector('p').classList.add('active');
            }
        </script>
    </section>
    <script src="../js/home.js"></script>
    <script src="../js/language.js"></script>
</body>

</html>
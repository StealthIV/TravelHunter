<?php
session_start();
if (!isset($_SESSION["UserName"])) {
    header("location: index.php");
    exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
    // Fetch the logged-in user's details if not already in session
    if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
        $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(['UserName' => $UserName]);
        $user = $pdoResult->fetch();

        // Ensure we have a user record
        if (!$user) {
            echo "User not found.";
            exit();
        }

        // Store user details in session
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['UserName'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['profile_image'] = $user['image'];
    }

    // Access the user's data from session variables
    $id = $_SESSION['id'];
    $full_name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $profile_image = $_SESSION['profile_image'];

} catch (PDOException $error) {
    echo "Error fetching user details: " . $error->getMessage();
    exit;
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
    <link rel="stylesheet" href="../style/categories.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <section class="overlay"></section>

    <section class="main">
        <div class="page-content">
            <div class="records table-responsive">
                <table id="info-table" class="table">
                    <thead>
                        <tr>
                            <th style='width: 20%;'>Name</th>
                            <th style='width: 20%;'>Email</th>
                            <th style='width: 20%;'>Phone</th>
                            <th style='width: 20%;'>Number of Days</th>
                            <th style='width: 20%;'>Booking Date</th>
                            <th style='width: 20%;'>Package</th>
                            <th style='width: 20%;'>Number of Guests</th>
                            <th style='width: 20%;'>Total Amount</th>
                            <th style='width: 20%;'>Payment Method</th>
                            <th style='width: 20%;'>Reference</th>
                            <th style='width: 20%;'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to fetch the booking history
                        $pdoQuery = 'SELECT h.history_id, h.phone, h.days, h.checkin, h.package, h.guests, h.amount, h.payment, h.Reference
                                     FROM historybookings h
                                     WHERE h.user_id = :user_id';
                        $pdoResult = $pdoConnect->prepare($pdoQuery);
                        $pdoResult->execute(['user_id' => $id]);

                        while ($row = $pdoResult->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td style='width: 20%;'>{$full_name }</td>";
                            echo "<td style='width: 20%;'>{$email}</td>";
                            echo "<td style='width: 20%;'>{$row['phone']}</td>";
                            echo "<td style='width: 20%;'>{$row['days']}</td>";
                            echo "<td style='width: 20%;'>{$row['checkin']}</td>";
                            echo "<td style='width: 20%;'>{$row['package']}</td>";
                            echo "<td style='width: 20%;'>{$row['guests']}</td>";
                            echo "<td style='width: 20%;'>{$row['amount']}</td>";
                            echo "<td style='width: 20%;'>{$row['payment']}</td>";
                            echo "<td style='width: 20%;'>{$row['Reference']}</td>";
                            echo "<td style='width: 20%;'>
                                    <a href='boracaydelete.php?id={$row['history_id']}' onclick=\"return confirm('Are you sure you want to delete this booking?');\"><i class='bx bx-trash'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="../js/home.js"></script>
    <script src="../js/language.js"></script>
    <script src="../js/categories.js" defer></script>
</body>
</html>

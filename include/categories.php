@ -1,114 +1,113 @@
<?php
session_start();
if (!isset($_SESSION["UserName"])) {
    header("location: index.php");
    exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
    // Fetch user details, including user ID
    $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['UserName' => $UserName]);
    $user = $pdoResult->fetch();
    $userId = $user['history_id']; // Assuming 'id' is the column name for the user ID
    $full_name =$user['fullname'];
    $profile_image = $user['image']; // Assuming this is the URL to the profile image

} catch (PDOException $error) {
    echo $error->getMessage() . '';
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
    <?php require_once 'nav.php' ?>
    <section class="overlay"></section>

    <section class="main">
        <div class="page-content">
            <div class="records table-responsive">
                <div class="record-header">
                    <div class="browse">
                        <input type="search" placeholder="Search" class="record-search">
                    </div>
                </div>
                <table id="info-table" width="100%">
                    <thead>
                        <tr>
                            <th style='width: 10%;'>ID</th>
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
                        // Fetch bookings specific to the logged-in user using user ID
                        $pdoQuery = 'SELECT * FROM historybookings WHERE history_id = :history_id'; // Make sure 'user_id' is the correct column name
                        $pdoResult = $pdoConnect->prepare($pdoQuery);
                        $pdoResult->execute(['history_id' => $userId]); // Pass the user ID to filter bookings

                        // Check if there are bookings
                        if ($pdoResult->rowCount() > 0) {
                            while ($row = $pdoResult->fetch(PDO::FETCH_ASSOC)) {
                                extract($row);
                                echo "<tr>";
                                echo "<td style='width: 10%;'>$id</td>";
                                echo "<td style='width: 15%;'>$name</td>";
                                echo "<td style='width: 15%;'>$email</td>";
                                echo "<td style='width: 15%;'>$phone</td>";
                                echo "<td style='width: 15%;'>$days</td>";
                                echo "<td style='width: 15%;'>$checkin</td>";
                                echo "<td style='width: 15%;'>$package</td>";
                                echo "<td style='width: 15%;'>$guests</td>";
                                echo "<td style='width: 15%;'>$amount</td>";
                                echo "<td style='width: 15%;'>$payment</td>";
                                echo "<td style='width: 15%;'>$Reference</td>";
                                echo "<td style='width: 15%;'><a href='boracaydelete.php?id=$id'><i class='bx bx-trash'></i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12' style='text-align:center;'>No bookings found.</td></tr>";
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
<?php
session_start();
if (!isset($_SESSION["UserName"])) {
    header("location: index.php");
    exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
    // Fetch the logged-in user's details
    $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['UserName' => $UserName]);
    $user = $pdoResult->fetch();

    // Ensure we have a user record
    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Get the user's ID for filtering the bookings
    $id = $user['id'];
    $profile_image = $user['image']; 
    $full_name = $user['FullName'];

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
    <link rel="stylesheet" href="../style/categories.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php require_once 'nav.php'; ?>
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
                            <th style='width: 20%;'>Name</th>
                            <th style='width: 15%;'>Email</th>
                            <th style='width: 15%;'>Phone</th>
                            <th style='width: 10%;'>Number of Days</th>
                            <th style='width: 10%;'>Booking Date</th>
                            <th style='width: 10%;'>Package</th>
                            <th style='width: 10%;'>Number of Guests</th>
                            <th style='width: 10%;'>Downpayment</th>
                            <th style='width: 10%;'>Balance</th>
                            <th style='width: 10%;'>Payment Method</th>
                            <th style='width: 10%;'>Reference</th>
                            <th style='width: 10%;'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php
                        // Fetch the user's booking history from the historybookings table
                        $pdoQuery = 'SELECT `history_id`, `id`, `name`, `email`, `phone`, `days`, `checkin`, `package`, `guests`, `downpayment`, `balance`, `Reference` 
                                     FROM `historybookings` 
                                     WHERE id = :id';
                        $pdoResult = $pdoConnect->prepare($pdoQuery);
                        $pdoResult->execute(['id' => $user_id]);  // Filter by user_id
                        while ($row = $pdoResult->fetch(PDO::FETCH_ASSOC)) {
                          extract($row);
                          echo "<tr>";
                                echo "<td style='width: 15%;'>$name</td>";
                                echo "<td style='width: 15%;'>$email</td>";
                                echo "<td style='width: 15%;'>$phone</td>";
                                echo "<td style='width: 10%;'>$days</td>";
                                echo "<td style='width: 10%;'>$checkin</td>";
                                echo "<td style='width: 10%;'>$package</td>";
                                echo "<td style='width: 10%;'>$guests</td>";
                                echo "<td style='width: 10%;'>$downpayment</td>";
                                echo "<td style='width: 10%;'>$balance</td>";
                                echo "<td style='width: 10%;'>$payment</td>";
                                echo "<td style='width: 10%;'>$Reference</td>";
                                echo "<td style='width: 10%;'>
                                        <a href='boracaydelete.php?id=$id' onclick=\"return confirm('Are you sure you want to delete this booking?');\"><i class='bx bx-trash'></i></a>
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

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: admin.php");
    exit();
}

require_once '../connect/dbcon.php';

$userId = $_SESSION['id'];  // Use session ID to fetch the user's data

try {
    // Fetch user information based on the session ID
    $pdoQuery = "SELECT * FROM user WHERE id = :id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['id' => $userId]);
    $user = $pdoResult->fetch();

    if (!$user) {
        echo "User not found.";
        exit;
    }
} catch (PDOException $error) {
    echo $error->getMessage();
    exit;
}
// Pagination settings for cancelbook
$limitCancel = 10; // Number of records per page
$pageCancel = isset($_GET['pageCancel']) ? (int) $_GET['pageCancel'] : 1;
$offsetCancel = ($pageCancel - 1) * $limitCancel;

// Get total number of cancellations
$totalCancelBookingsQuery = $pdoConnect->prepare("SELECT COUNT(*) as totalCancelBooking FROM cancelbook");
$totalCancelBookingsQuery->execute();
$totalCancelBookingResult = $totalCancelBookingsQuery->fetch(PDO::FETCH_ASSOC);
$totalCancelBookings = $totalCancelBookingResult['totalCancelBooking'];
$totalCancelPages = ceil($totalCancelBookings / $limitCancel);

// Fetch cancelbook entries for the current page
$cancelbookQuery = 'SELECT * FROM cancelbook LIMIT :limitCancel OFFSET :offsetCancel';
$cancelbookResult = $pdoConnect->prepare($cancelbookQuery);
$cancelbookResult->bindParam(':limitCancel', $limitCancel, PDO::PARAM_INT);
$cancelbookResult->bindParam(':offsetCancel', $offsetCancel, PDO::PARAM_INT);
$cancelbookResult->execute();
$cancelbookEntries = $cancelbookResult->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="../style/manage.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
</head>

<body>

    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>M<span>angement</span></h3>
        </div>


        <div class="side-menu">
            <ul>
                <li>
                    <a href="" >
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="../crud/req.php" class="active">
                        <span> <i class="fa-solid fa-file-waveform"></i> </span> <br>

                        <small>Request</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span> <i class="fa-solid fa-file-waveform"></i> </span> <br>

                        <small>Annoucement</small>
                    </a>
                </li>

                <li>
                    <a href="manage_edit.php">
                        <span class="las la-user-alt"></span>
                        <small>Personal Info</small>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div>

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <div class="user">
                        <span><a href="logout.php"><i
                                    class="fa-solid fa-right-from-bracket"></i>Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
        <main>



            <div class="page-header">
                <h1>Request</h1>
                <small>Home / Request</small>
            </div>

            <div class="page-content">
                <h2>Cancellation Requests</h2>
                <div class="records table-responsive">
                    <table id="cancelbook-table" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Request Type</th>
                                <th>Reason</th>
                                <th>Booking ID</th>
                                <th>Refund Method</th>
                                <th>Receiver Number</th>
                                <th>Rebooking Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cancelbookEntries as $row): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['request_type']; ?></td>
                                    <td><?php echo $row['reason']; ?></td>
                                    <td><?php echo $row['booking_id']; ?></td>
                                    <td><?php echo $row['refund_method']; ?></td>
                                    <td><?php echo $row['receiver_number']; ?></td>
                                    <td><?php echo $row['rebooking_date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>
                                        <a href='approve_cancel.php?id=<?php echo $row['id']; ?>'
                                            class="btn btn-confirm">Approve</a>
                                        <a href='delete_cancel.php?id=<?php echo $row['id']; ?>'
                                            class="btn btn-delete">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination Controls for cancelbook -->
                    <div class="pagination">
                        <?php if ($pageCancel > 1): ?>
                            <a href="?pageCancel=<?php echo $pageCancel - 1; ?>">&laquo; Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalCancelPages; $i++): ?>
                            <a href="?pageCancel=<?php echo $i; ?>"
                                class="<?php echo $i === $pageCancel ? 'active' : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($pageCancel < $totalCancelPages): ?>
                            <a href="?pageCancel=<?php echo $pageCancel + 1; ?>">Next &raquo;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        let searchBox = document.querySelector('.record-search');
        let rows = document.querySelectorAll('#info-table tbody tr');
        console.log(rows);

        searchBox.addEventListener('input', () => {
            console.log('start');
            let searchValue = searchBox.value.trim().toLowerCase();



            rows.forEach(row => {
                console.log('row');
                let id = row.querySelector('td:first-child').textContent.toLowerCase();
                let userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                let fullName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();


                if (searchValue === "" || id.includes(searchValue)) {
                    // If the search input is empty or matches the ID, show the row
                    row.style.display = 'table-row';
                    console.log("true")
                } else {
                    // Hide the row if it doesn't match the search value
                    row.style.display = 'none';
                    console.log("false")

                }
            });
        });

    </script>

</body>

</html>
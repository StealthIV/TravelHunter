<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: manage.php");
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
    // Log the error (use error_log or a logging library)
    error_log($error->getMessage());
    echo "An error occurred while fetching data. Please try again later.";
    exit;
}

// Pagination settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total number of bookings
$totalBookingsQuery = $pdoConnect->prepare("SELECT COUNT(*) as totalBooking FROM bookings");
$totalBookingsQuery->execute();
$totalBookingResult = $totalBookingsQuery->fetch(PDO::FETCH_ASSOC);
$totalBookings = $totalBookingResult['totalBooking'];
$totalPages = ceil($totalBookings / $limit);

// Fetch bookings for the current page with user information
$pdoQuery = "
  SELECT bookings.*, user.FullName AS user_name, user.UserName AS user_email 
FROM bookings 
JOIN user ON bookings.user_id = user.id 
ORDER BY bookings.id DESC 
LIMIT :limit OFFSET :offset
";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoResult->bindParam(':limit', $limit, PDO::PARAM_INT);
$pdoResult->bindParam(':offset', $offset, PDO::PARAM_INT);
$pdoResult->execute();
$bookings = $pdoResult->fetchAll(PDO::FETCH_ASSOC);
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
            <h3>M<span>agement</span></h3>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="" class="active">
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="req.php">
                        <span> <i class="fa-solid fa-file-waveform"></i> </span> <br>

                        <small>Request</small>
                    </a>
                </li>
                <li>
                    <a href="admin.php">
                        <span class="las la-note-alt"></span>

                        <a href="admin.php"> <small>Annoucement</small></a>
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

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <div class="user">
                        <span><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="page-header">
                <h1>Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>

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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Number of Days</th>
                                <th>Booking Date</th>
                                <th>Package</th>
                                <th>Number of Guests</th>
                                <th>Total Amount</th>
                                <th>Downpayment</th>
                                <th>Balance</th>
                                <th>Payment Method</th>
                                <th>Reference</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $row): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($row['days']); ?></td>
                                    <td><?php echo htmlspecialchars($row['checkin']); ?></td>
                                    <td><?php echo htmlspecialchars($row['package']); ?></td>
                                    <td><?php echo htmlspecialchars($row['guests']); ?></td>
                                    <td><?php echo htmlspecialchars(number_format($row['amount'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars(number_format($row['amount'] * 0.5, 2)); ?></td>
                                    <td><?php echo htmlspecialchars(number_format($row['amount'] - ($row['amount'] * 0.5), 2)); ?></td>
                                    <td><?php echo htmlspecialchars($row['payment']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Reference']); ?></td>
                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                    <td style='width: 15%;'>
                                        <?php if ($row['status'] !== 'confirmed'): ?>
                                            <a href="set_session1.php?id=<?php echo $row['id']; ?>&action=confirm"
                                                class="btn btn-confirm"
                                                onclick="return confirm('Are you sure you want to confirm this booking?');">Confirm</a>
                                        <?php endif; ?>
                                        <a href="set_session1.php?id=<?php echo $row['id']; ?>&action=delete"
                                            class="btn btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this booking?');">Delete
                                            <i class='bx bx-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        let searchBox = document.querySelector('.record-search');
        let rows = document.querySelectorAll('#info-table tbody tr');
        searchBox.addEventListener('input', () => {
            let searchValue = searchBox.value.trim().toLowerCase();
            rows.forEach(row => {
                let id = row.querySelector('td:first-child').textContent.toLowerCase();
                let userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                let fullName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (searchValue === "" || id.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        let timeout;
        searchBox.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                let searchValue = searchBox.value.trim().toLowerCase();
                rows.forEach(row => {
                    let rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchValue) ? 'table-row' : 'none';
                });
            }, 300); // Wait for 300ms before processing
        });
    </script>

</body>

</html>

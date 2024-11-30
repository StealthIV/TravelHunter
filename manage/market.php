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
    echo $error->getMessage();
    exit;
}

// Pagination settings
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

try {
    // Fetch total number of records for pagination
    $totalMarketQuery = $pdoConnect->prepare("SELECT COUNT(*) as totalMarket FROM market");
    $totalMarketQuery->execute();
    $totalMarketResult = $totalMarketQuery->fetch(PDO::FETCH_ASSOC);
    $totalMarkets = $totalMarketResult['totalMarket'];
    $totalPages = ceil($totalMarkets / $limit);

    // Fetch market records with pagination
    $pdoQuery = "SELECT `id`, `name`, `email`, `phone`, `address`, `checkin`, `Item`, `quantity`, `downpayment`, `balance`, `payment`, `Reference`, `status` FROM `market` LIMIT :limit OFFSET :offset";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->bindParam(':limit', $limit, PDO::PARAM_INT);
    $pdoResult->bindParam(':offset', $offset, PDO::PARAM_INT);
    $pdoResult->execute();
    $markets = $pdoResult->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    error_log("Error fetching data: " . $error->getMessage(), 3, "errors.log");
    exit;
}
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

    <style>
        /* Button Styles */
        .btn-confirm {
            background-color: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-delete {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-confirm:hover,
        .btn-delete:hover {
            opacity: 0.8;
        }
    </style>
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
                    <a href="manage.php" class="active">
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
                    <a href="manage_place.php">
                        <span class="las la-note-alt"></span>

                        <a href="manage_place.php"> <small>Add Places</small></a>
                    </a>
                </li>

                <li>
                    <a href="market.php">
                        <span class="las la-user-alt"></span>
                        <small>Market</small>
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
                <div class="analytics">

                    <div class="card">
                        <?php
                        // Count the total number of users
                        $totalBookingQuery = $pdoConnect->prepare("SELECT COUNT(*) as totalBooking FROM bookings ");
                        $totalBookingQuery->execute();
                        $totalBookingResult = $totalBookingQuery->fetch(PDO::FETCH_ASSOC);
                        $totalBooking = $totalBookingResult['totalBooking'];
                        ?>

                        <div class="card-head">
                            <h2>
                                <?php echo number_format($totalBooking); ?>
                            </h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Number of Bookings</small>
                            <div class="card-indicator">
                            </div>
                        </div>
                    </div>


                    <div class="page-content">
                        <div class="records table-responsive">
                            <div class="record-header">
                                <div class="browse">
                                    <input type="search" placeholder="Search" class="record-search">
                                </div>
                            </div>
                            <!-- HTML Table Structure -->
                            <table id="info-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Check-in Date</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Downpayment</th>
                                        <th>Balance</th>
                                        <th>Payment Method</th>
                                        <th>Reference</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($markets as $row): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                                            <td><?php echo htmlspecialchars($row['checkin']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Item']); ?></td>
                                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                            <td><?php echo htmlspecialchars($row['downpayment']); ?></td>
                                            <td><?php echo htmlspecialchars($row['balance']); ?></td>
                                            <td><?php echo htmlspecialchars($row['payment']); ?></td>
                                            <td><?php echo htmlspecialchars($row['Reference']); ?></td>
                                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                                            <td>
                                                <!-- Add buttons for actions like Confirm and Delete -->
                                                <?php if ($row['status'] !== 'confirmed'): ?>
                                                    <a href='update_status1.php?id=<?php echo $row['id']; ?>&status=confirmed'
                                                        class="btn btn-confirm"
                                                        onclick="return confirm('Are you sure you want to confirm this order?');">Confirm</a>
                                                <?php endif; ?>
                                                <a href='marketdelete.php?id=<?php echo $row['id']; ?>'
                                                    class="btn btn-delete"
                                                    onclick="return confirm('Are you sure you want to delete this order?');">Delete
                                                    <i class='bx bx-trash'></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </main>
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
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserName"])) {
    header("location: boracayadmin.php");
    exit();
}
if (!$user) {
    echo "User not found.";
    exit;
}

// Check if the user is an admin
if ($user['UserRole'] !== 'manager') {
    header("Location: ../include/index.php");  // Redirect to index.php if not an admin
    exit();
}

require_once '../connect/dbcon.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    echo "<h3>Welcome, Boracay Management " . $_SESSION["UserName"] . '</h3>';

} else {
    // Handle the case where the ID is not provided or invalid
    // You can redirect or display an error message
}

try {
    // Fetch user information based on the provided ID
    $pdoQuery = "SELECT * FROM bookings WHERE id = :id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['id' => $userId]);
    $user = $pdoResult->fetch();
} catch (PDOException $error) {
    echo $error->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="../style/admin.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
</head>

<body>

    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>A<span>dmin</span></h3>
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
                    <a href="../include/boracayad.php?id=<?php echo $_SESSION['id'] ?>">
                        <span> <i class="fa-solid fa-file-waveform"></i> </span> <br>

                        <small>Annoucement</small>
                    </a>
                </li>

                <li>
                    <a href="edit.php?id=<?php echo $_SESSION['id'] ?>">
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
                        <span><a href="../include/logout.php"><i
                                    class="fa-solid fa-right-from-bracket"></i>Logout</a></span>
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
                            <table id="info-table" width="100%">
                                <thead>
                                    <tr>
                                        <th style='width: 10%;'>ID</th>
                                        <th style='width: 20%;'>Name</th>
                                        <th style='width: 20%;'>Email</th>
                                        <th style='width: 20%;'>Phone</th>
                                        <th style='width: 20%;'>Number of Days</th>
                                        <th style='width: 20%;'> Booking Date</th>
                                        <th style='width: 20%;'>Package</th>
                                        <th style='width: 20%;'>Number of Guests</th>
                                        <th style='width: 20%;'>Total Amount</th>
                                        <th style='width: 20%;'>Payment Method</th>
                                        <th style='width: 20%;'>Reference</th>
                                        <th style='width: 20%;'>action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $pdoQuery = 'SELECT * FROM bookings';
                                    $pdoResult = $pdoConnect->prepare($pdoQuery);
                                    $pdoResult->execute();
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

                                        echo "<td style='width: 15%;'> 
            <a href='boracaydelete.php?id=$id'><i class='bx bx-trash'></i></a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>
        </main>

        <div class="page-content">
            <div class="analytics">

                <div class="card">
                    <?php
                    // Count the total number of users
                    $totalBookingQuery = $pdoConnect->prepare("SELECT COUNT(*) as totalproduct FROM boracaymarket ");
                    $totalBookingQuery->execute();
                    $totalBookingResult = $totalBookingQuery->fetch(PDO::FETCH_ASSOC);
                    $totalBooking = $totalBookingResult['totalproduct'];
                    ?>

                    <div class="card-head">
                        <h2>
                            <?php echo number_format($totalBooking); ?>
                        </h2>
                        <span class="las la-user-friends"></span>
                    </div>
                    <div class="card-progress">
                        <small>Number of product</small>
                        <div class="card-indicator">
                        </div>
                    </div>
                </div>
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
                                <th style='width: 20%;'>Address</th>
                                <th style='width: 20%;'>Product</th>
                                <th style='width: 20%;'>Amount</th>
                                <th style='width: 20%;'>Payment Method</th>
                                <th style='width: 20%;'>Reference</th>
                                <th style='width: 20%;'>action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $pdoQuery = 'SELECT * FROM boracaymarket';
                            $pdoResult = $pdoConnect->prepare($pdoQuery);
                            $pdoResult->execute();
                            while ($row = $pdoResult->fetch(PDO::FETCH_ASSOC)) {
                                extract($row);
                                echo "<tr>";
                                echo "<td style='width: 10%;'>$id</td>";
                                echo "<td style='width: 15%;'>$name</td>";
                                echo "<td style='width: 15%;'>$email</td>";
                                echo "<td style='width: 15%;'>$phone</td>";
                                echo "<td style='width: 15%;'>$address</td>";
                                echo "<td style='width: 15%;'>$Product</td>";
                                echo "<td style='width: 15%;'>$amount</td>";
                                echo "<td style='width: 15%;'>$payment</td>";
                                echo "<td style='width: 15%;'>$reference</td>";

                                echo "<td style='width: 15%;'> 
            <a href='boracaydelete.php?id=$id'><i class='bx bx-trash'></i></a></td>";
                                echo "</tr>";
                            }
                            ?>
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
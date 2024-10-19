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
    // Fetch user information based on the provided ID
    $pdoQuery = "SELECT * FROM user WHERE id = :id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['id' => $userId]);
    $user = $pdoResult->fetch();


    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoQuery = "SELECT * FROM `audit_trail` ORDER BY `timestamp` DESC";
    $pdoResult = $pdoConnect->query($pdoQuery);
    $audittrailData = $pdoResult->fetchAll(PDO::FETCH_ASSOC);

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
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
</head>

<body>

    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>A<span>dmin</span></h3>
        </div>

        <div class="side-content">
            <div class="profile">
                <?php
                $id = $user["id"];
                $UserName = $user["UserName"];
                $FullName = $user["FullName"];
                $image = $user["image"];

                ?>
                <div class="profile-img bg-img" style="background-image: url(../pic/<?php echo $image; ?>)"></div>
                <small>
                    <?php echo $FullName; ?>
                </small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                        <a href="admin.php">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="audit.php" class="active">
                        <span> <i class="fa-solid fa-file-waveform"></i> </span> <br>

                            <small>Audit Trail</small>
                        </a>
                    </li>
                    <li>
                        <a href="edit.php">
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
                <h1>Audit</h1>
                <small>trail</small>
            </div>

            <div class="container">
        <?php if (isset($audittrailData) && !empty($audittrailData)): ?>
            <table border="1">
                <tr>
                    <?php foreach ($audittrailData as $log): ?>
                        <td>
                            <?= $log['action'] ?>
                        </td>
                        <td>
                            <?= $log['user'] ?> 
                        </td>
                        <td>
                            <?= $log['timestamp'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>no Audit Available</p>
        <?php endif; ?>

    </div>



            <div class="page-content">
                <div class="analytics">

                    <div class="card">
                        <?php
                        // Count the total number of users
                        $totalUsersQuery = $pdoConnect->prepare("SELECT COUNT(*) as totalUsers FROM user");
                        $totalUsersQuery->execute();
                        $totalUsersResult = $totalUsersQuery->fetch(PDO::FETCH_ASSOC);
                        $totalUsers = $totalUsersResult['totalUsers'];
                        ?>


                    </div>


                    <div class="page-content">


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
<?php
session_start();


require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];
$UserId = $_SESSION['id']; // Get user ID from session

try {
    // Fetch user details based on session user ID
    $pdoQuery = "SELECT * FROM user WHERE id = :UserId"; // Use user ID here
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['UserId' => $UserId]);
    $user = $pdoResult->fetch();
    if (!$user) {
        throw new Exception("User not found.");
    }

    $profile_image = !empty($user['image']) ? $user['image'] : 'default_profile.jpg';
    $full_name = $user['FullName'];
    $email = $user['UserName'];
    $password = $user['PassWord'];
} catch (PDOException $error) {
    echo "Database error: " . $error->getMessage();
    exit();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="../style/edit.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            // Refresh profile image on load to avoid cache issues
            var profileImage = document.querySelector('.profile-header img');
            profileImage.src = profileImage.src + '?' + new Date().getTime();
        };
    </script>
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
                    <a href="manage.php">
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
                    <a href="manageplace.php">
                        <span class="las la-note-alt"></span>

                        <a href="admin.php"> <small>Add Places</small></a>
                    </a>
                </li>

                <li>
                    <a href="market.php">
                        <span class="las la-user-alt"></span>
                        <small>Market</small>
                    </a>
                </li>

                <li>
                    <a href="manage_edit.php" class="active">
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
                <h1>Personal</h1>
                <small>information</small>
            </div>

            <div class="profile-container">
                <div class="account-details-box">
                    <div class="profile-header">
                        <img src="../pic/<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image">
                        <h2><?php echo htmlspecialchars($full_name); ?></h2>
                        <p><?php echo htmlspecialchars($email); ?></p>
                    </div>
                    <div class="profile-details">
                        <div>
                            <label>Full Name:</label>
                            <span><?php echo htmlspecialchars($full_name); ?></span>
                        </div>
                        <div>
                            <label>Email:</label>
                            <span><?php echo htmlspecialchars($email); ?></span>
                        </div>
                        <div>
                            <label>Password:</label>
                            <span><?php echo str_repeat('*', strlen($password)); ?></span>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button onclick="window.location.href='edit_profile.php'">Edit Profile</button>
                    </div>
                    <div class="back-button-container">
                        <button onclick="goBack()">Back</button>
                    </div>
                </div>
            </div>
        </main>

        <script>
            function goBack() {
                window.location.href = "home.php";
            }
        </script>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/styles.css">
    <title>display</title>
</head>

<body>
    <div class="container">
        <h1>crud</h1>
        <p>landing page</p>
    </div>

    <?php
    require_once "../connect/dbcon.php";
    session_start();

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        
        // Retrieve user information before deletion for audit trail
        $userQuery = "SELECT * FROM bookings WHERE id = :id";
        $userResult = $pdoConnect->prepare($userQuery);
        $userResult->execute(array("id" => $userId));
        $user = $userResult->fetch(PDO::FETCH_ASSOC);

        $pdoQuery = "DELETE FROM bookings WHERE id = :id";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $success = $pdoResult->execute(array("id" => $userId));

        if ($success) {
            $pdoQuery = "INSERT INTO `audit_trail`(`action`) VALUES('User Deleted')";
            $pdoResult = $pdoConnect->prepare($pdoQuery);
            $pdoResult->execute();

            header("Location: boracayadmin.php?id=");
            exit();

        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "Invalid request. Please provide a valid id.";
    }

    $pdoConnect = null;
    ?>
</body>

</html>
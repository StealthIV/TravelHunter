<?php
session_start();

require_once "../connect/dbcon.php";

// Check if the user is logged in
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: manage.php");  // Redirect to manage.php if not logged in
    exit();
}

$userId = $_SESSION['id'];  // Use session ID to fetch the user's data

try {
    // Fetch user information based on the session ID
    $pdoQuery = "SELECT * FROM user WHERE id = :id"; // Use user ID here
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['id' => $userId]);
    $user = $pdoResult->fetch();

    // Check if user is found
    if (!$user) {
        echo "User not found.";
        exit;
    }

    // Check if the user is a manager
    if ($user['UserRole'] !== 'manager') {
        header("Location: ../include/index.php");  // Redirect to index.php if not a manager
        exit();
    }

    // Fetch audit trail data
    $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoQuery = "SELECT * FROM `audit_trail` ORDER BY `timestamp` DESC";
    $pdoResult = $pdoConnect->query($pdoQuery);
    $audittrailData = $pdoResult->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $error) {
    $message = $error->getMessage();
    echo "Database error: " . $message;
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trail</title>
    <link rel="stylesheet" type="text/css" href="../style/audits.css">

</head>

<body>
    <div class="container">
        <h1>Welcome to PRJ</h1>
        <p>Audit customize</p>

        <br />

    </div>

    <?php
    if (isset($_SESSION['$UserName'])) {
        $UserName = $_SESSION['UserName'];
        echo '<h3 align = "center">Welcome,' . $UserName . '!</h3>';
    }
    ?>
    <!-- <div>
        <p>User information:</p>
        <ul>
     <li><strong>Username:</strong><?php echo $user['UserName']; ?>
    <li><strong>FullName:</strong><?php echo $user['FullName']; ?>
</ul>
</div -->
    <br>
    <a href="../crud/read.php">Add user</a> <br>
    <a href="../include/dropdown.php">Drop down</a> <br>
    <a href="../include/audit_trail.php">Audit trail</a> <br>
    <a href="logout.php">Logout</a> <br>

    <div class="container">
        <h2>Trail Data</h2>
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
</body>

</html>
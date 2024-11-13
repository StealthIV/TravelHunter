<?php
session_start();

if (!$user) {
    echo "User not found.";
    exit;
}

// Check if the user is an admin
if ($user['UserRole'] !== 'admin') {
    header("Location: ../include/index.php");  // Redirect to index.php if not an admin

    exit();
}


// Check if the user is logged in
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: admin.php");
    exit();
}

require_once '../connect/dbcon.php';

// Get user ID from the query parameter (for initial fetch)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = intval($_GET['id']);
} else {
    echo "Invalid user ID.";
    exit;
}

try {
    // Fetch user information based on the provided ID
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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["modify"])) {
    // Get user input
    $UserName = htmlspecialchars($_POST["User"]);
    $PassWord = password_hash($_POST["Pass"], PASSWORD_DEFAULT);
    $FullName = htmlspecialchars($_POST["FName"]);
    $UserRole = htmlspecialchars($_POST["UserRole"]);

    // Check if a new file is uploaded
    if (!empty($_FILES["profileImage"]["tmp_name"])) {
        // Get the file name
        $newImageName = basename($_FILES["profileImage"]["name"]);

        // Move the uploaded file to the desired directory
        move_uploaded_file($_FILES["profileImage"]["tmp_name"], "../pic/" . $newImageName);

        // Update the image field in the database
        $pdoQuery = $pdoConnect->prepare("UPDATE user SET image = :newImageName WHERE id = :id");
        $pdoQuery->execute(['newImageName' => $newImageName, 'id' => $userId]);
    } else {
        // Use existing image if no new image is uploaded
        $newImageName = $user['image'];
    }

    // Update other user information in the database
    $pdoQuery = $pdoConnect->prepare("UPDATE user SET UserName = :UserName, PassWord = :password, FullName = :fullName, UserRole = :UserRole WHERE id = :id");
    $pdoResult = $pdoQuery->execute([
        ':UserName' => $UserName,
        ':password' => $PassWord,
        ':fullName' => $FullName,
        ':UserRole' => $UserRole,
        ':id' => $userId
    ]);

    if ($pdoResult) {
        // Log the action in the audit trail table
        $auditQuery = "INSERT INTO `audit_trail` (`action`, `user`) VALUES ('User updated', :user)";
        $auditResult = $pdoConnect->prepare($auditQuery);
        $auditResult->execute(['user' => $_SESSION["UserName"]]);

        header("Location: ../crud/manage.php");
        exit();
    } else {
        echo "Update failed: " . implode(" ", $pdoQuery->errorInfo());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../style/prof.css">
    <title>Update User</title>
</head>
<body>
    <div class="container">
        <h1>Update User Information</h1>
    </div>

    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
        <div class="profile-image-container">
            <img src="../pic/<?php echo htmlspecialchars($user['image']); ?>" alt="Profile Image" class="profile-image">
        </div>
        <label>Profile Image (Optional):</label>
        <input type="file" name="profileImage"><br>
        <label>Username:</label>
        <input type="text" name="User" value="<?php echo htmlspecialchars($user['UserName']); ?>" required placeholder="Username"><br>
        <label>Password:</label>
        <input type="password" name="Pass" required placeholder="Password"><br>
        <label>Full Name:</label>
        <input type="text" name="FName" value="<?php echo htmlspecialchars($user['FullName']); ?>" required placeholder="Full Name"><br>
        <label>User Role:</label>
        <input type="text" name="UserRole" value="<?php echo htmlspecialchars($user['UserRole']); ?>" required placeholder="User Role"><br>
        <input type="submit" name="modify" value="Update">
    </form>
    <br>
    <a href="../crud/manage.php">Back to Management</a>
</body>
</html>

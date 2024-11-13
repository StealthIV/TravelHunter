<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../style/prof.css">
    <title>welcome</title>
</head>

<body>
    <div class="container">
        <h1>welcome to update</h1>
        <p>update page</p>
    </div>

    <?php
    session_start();

    if (!$user) {
        echo "User not found.";
        exit;
    }

    // Check if the user is an admin
    if ($user['UserRole'] !== 'manager') {
        header("Location: ../include/index.php");  // Redirect to index.php if not an admin
        exit();
    }

    // Check if the user is logged in
    if (!isset($_SESSION["UserName"])) {
        header("location: ../include/index.php");
        exit();
    }

    require_once '../connect/dbcon.php';

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

    } else {
        // Handle the case where the ID is not provided or invalid
        // You can redirect or display an error message
    }

    try {
        // Fetch user information based on the provided ID
        $pdoQuery = "SELECT * FROM user WHERE id = :id";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(['id' => $userId]);
        $user = $pdoResult->fetch();
    } catch (PDOException $error) {
        echo $error->getMessage();
        exit;
    }

    // Check if the form is submitted
    if (!empty($_POST["modify"])) {
        // Get user input
        $name = htmlspecialchars($_POST["name"]);
        $email = password_hash($_POST["email"], PASSWORD_DEFAULT);
        $phone = htmlspecialchars($_POST["phone"]);
        $days = htmlspecialchars($_POST["days"]);
        $checkin = htmlspecialchars($_POST["checkin"]);
        $package = htmlspecialchars($_POST["package"]);
        $guests = htmlspecialchars($_POST["guests"]);
        $amount = htmlspecialchars($_POST["amount"]);
        $payment = htmlspecialchars($_POST["payment"]);
        $reference = htmlspecialchars($_POST["reference"]);


        // Update other user information in the database
        $pdoQuery = $pdoConnect->prepare("UPDATE bookings SET name = :name, email = :email, phone = :phone, days = :days, 
        checkin = :checkin, package = :package, guests = :guests, amount = :amount, payment = :payment, reference = :reference,  WHERE id = :id");

        $pdoResult = $pdoQuery->execute(
            array(
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':days' => $days,
                ':checkin' => $checkin,
                ':package' => $package,
                ':guests' => $guests,
                ':amount' => $amount,
                ':payment' => $payment,
                ':reference' => $reference,
                ':id' => $_GET["id"]
            )
        );

        if ($pdoResult) {
            // Log the action in the audit trail table
            $auditQuery = "INSERT INTO `audit_trail` (`action`) VALUES ('User updated')";
            $auditResult = $pdoConnect->prepare($auditQuery);
            $auditResult->execute();

            header("Location: ../crud/manage.php?id=" . $_SESSION["id"]);
            exit();

        } else {
            echo "Update failed: " . implode(" ", $pdoQuery->errorInfo());
        }
    }

    // Fetch user information again to populate the form
    $pdoQuery = $pdoConnect->prepare("SELECT * FROM user WHERE id = :id");
    $pdoQuery->execute(array(':id' => $_GET["id"]));
    $pdoResult = $pdoQuery->fetchAll();
    $pdoConnect = null;

    ?>
    <br>

    <form action="update.php?id=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
        <?php
        $image = $user["image"];
        ?>
        <div class="profile-image-container">
            <img src="../pic/<?php echo $newImageName ?? $image; ?>" alt="Profile Image" class="profile-image">
        </div>
        name:(Optional)<input type="file" name="profileImage"><br>
        email : <input type="text" name="User" value="<?php echo $pdoResult[0]['UserName']; ?>" required
            placeholder="UserName"> <br>
        Password: <input type="password" name="Pass" value="<?php echo $pdoResult[0]['PassWord']; ?>" required
            placeholder="Password"><br>
        Fullname: <input type="text" name="FName" value="<?php echo $pdoResult[0]['FullName']; ?>" required
            placeholder="FullName"><br>
        UserRole: <input type="text" name="UserRole" value="<?php echo $pdoResult[0]['UserRole']; ?>" required
            placeholder="UserRole"><br>
        <input type="submit" name="modify" value="Update">
    </form>
    <br>

    <a href="../crud/manage.php?id=<?php echo $_SESSION["id"]; ?>">Back to Login</a>

</body>

</html>
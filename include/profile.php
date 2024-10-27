<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("location: index.php");
  exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
  $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['UserName' => $UserName]);
  $user = $pdoResult->fetch();
  $profile_image = $user['image']; // Assuming this is the URL to the profile image

} catch (PDOException $error) {
  echo $error->getMessage() . '';
  exit;
}

?>

<?php
// Check if the user is logged in
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];

  try {
    // Fetch the user's details from the database using user_id
    $stmt = $pdoConnect->prepare("SELECT UserName, FullName, PassWord, image FROM user WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      // Extract user details
      $email = $user['UserName'];
      $full_name = $user['FullName'];
      $password = $user['PassWord'];
      $profile_image = !empty($user['image']) ? $user['image'] : 'img/default_profile.jpg'; // Fallback to default image
    } else {
      // Handle the case where user details are not found
      echo "User details not found.";
      exit();
    }
  } catch (PDOException $e) {
    // Handle database connection error or query failure
    echo "Error: " . $e->getMessage();
    exit();
  }
} else {
  // Redirect to the login page if the user is not logged in
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/profile.css">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

  <title>Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

  .account-details-box{
    width: 900px;
    height: 300px;
    background: url(../img/cof.jpg);
    background-size: cover;
  }

    .profile-header {
      position: static;
     margin-left: 20px;
      margin-top: 100px;
    }

    .profile-header img {
      position: absolute;
      width: 150px;
      height: 150px;
     margin-top: 50px;
      border-radius: 50%;
    }
    .prof{
      position: absolute;
      margin-top: 120px;
      margin-left: 170px;
    }

    .profile-header h2 {
      margin: 10px 0 0;
      font-size: 24px;
      color: white;
      
    }

    .profile-header p {
  
      margin: 5px 0;
      color: white;
     
    }

    .profile-details {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .profile-details div {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      background: #f9f9f9;
      border-radius: 4px;
    }

    .profile-details div label {
      font-weight: bold;
    }

    .profile-details div span {
      color: #555;
    }

    .profile-actions {
      text-align: center;
      margin-top: 20px;
    }

    .profile-actions button {
      padding: 10px 20px;
      position: relative;
      border: none;
      background: #0A5831;
      color: white;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 230px;
      margin-left: 740px;
    }

    .profile-actions button:hover {
      background: #084423;
    }

    .back-button-container {
      text-align: left;
      margin-top: 20px;
    }

    .back-button-container button {
      padding: 10px 20px;
      border: none;
      background: #ddd;
      color: #333;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .back-button-container button:hover {
      background-color: #ccc;
    }
  </style>
</head>

<body>

  <?php require_once 'nav.php' ?>


  <section class="overlay"></section>

    <div class="account-details-box">
      <div class="profile-header">
        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image">
        <!-- Display Full Name -->
         <div class="prof">
        <h2><?php echo htmlspecialchars($full_name); ?></h2>
        <p><?php echo htmlspecialchars($email); ?></p>
      </div>
      </div>
      
      <div class="profile-actions">
        <button onclick="window.location.href='edit_profile.php'">Edit Profile</button>
      </div>

      
      <script src="../js/home.js"></script>
      <script src="../js/language.js"></script>
    </div>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("Location: index.php");
  exit();
}

require_once '../connect/dbcon.php';

// Define variables for messages and itinerary data
$successMessage = '';
$errorMessage = '';
$itineraryItems = [];

$UserName = $_SESSION["UserName"];

try {
  $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['UserName' => $UserName]);
  $user = $pdoResult->fetch();
  $profile_image = $user['image']; // Assuming this is the URL to the profile image
  $full_name = $user['FullName'];

  if ($user) {
    $userId = $user['id']; // Get the user ID

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve the data from the form
      $activity = $_POST['activity'];
      $date = $_POST['date'];
      $time = $_POST['time'];
      $location = $_POST['location'];

      // Prepare an SQL statement to insert the data
      $insertQuery = "INSERT INTO itinerary (Activity, Date, Time, Location, id) 
                            VALUES (:Activity, :Date, :Time, :Location, :id)";
      $insertResult = $pdoConnect->prepare($insertQuery);

      // Execute the insert query with the form data and user id
      $insertResult->execute([
        ':Activity' => $activity,
        ':Date' => $date,
        ':Time' => $time,
        ':Location' => $location,
        ':id' => $userId
      ]);

      // Show success message
      $successMessage = "Itinerary saved successfully!";
    }

    // Fetch all itinerary items for the current user only by matching user id
    $itineraryQuery = "SELECT * FROM itinerary WHERE id = :id";
    $itineraryResult = $pdoConnect->prepare($itineraryQuery);
    $itineraryResult->execute([':id' => $userId]);
    $itineraryItems = $itineraryResult->fetchAll();

  } else {
    $errorMessage = "User not found.";
  }

} catch (PDOException $error) {
  $errorMessage = "Error: " . $error->getMessage();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Hunter</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../style/itenerary.css">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

</head>

<body>
 <?php require_once "nav.php";?>

  <section class="overlay"></section>

  <Section class="main">


    <div class="container">
      <h1>My Travel Itinerary</h1>

      <!-- Success or Error Messages -->
      <?php if ($successMessage): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
      <?php endif; ?>

      <?php if ($errorMessage): ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
      <?php endif; ?>

<!-- Itinerary Form -->
<form method="POST" action="">
  <select name="activity" required>
    <option value="" disabled selected>Select Activity</option>
    <option value="Hiking">Hiking</option>
    <option value="City Tour">City Tour</option>
    <option value="Beach">Beach</option>
    <option value="Museum Visit">Museum Visit</option>
    <option value="Food Trip">Food Trip</option>
    <option value="Shopping">Shopping</option>
    <option value="Other">Other</option>
  </select>
  <input type="date" name="date" required>
  <input type="time" name="time" required>
  <input type="text" name="location" placeholder="Location" required>
  <button type="submit">Add Activity</button>
</form>


      <!-- Itinerary Table -->
      <table id="itineraryTable">
        <thead>
          <tr>
            <th>Activity</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($itineraryItems) > 0): ?>
            <?php foreach ($itineraryItems as $item): ?>
              <tr>
                <td><?php echo htmlspecialchars($item['Activity']); ?></td>
                <td><?php echo htmlspecialchars($item['Date']); ?></td>
                <td><?php echo htmlspecialchars($item['Time']); ?></td>
                <td><?php echo htmlspecialchars($item['Location']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4">No itinerary added yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </Section>

  <script src="../js/home.js"></script>
  <script src="../js/language.js"></script>
</body>

</html>
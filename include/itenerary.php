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
  // Fetch the user's id from the session using their UserName
  $pdoQuery = "SELECT id FROM user WHERE UserName = :UserName";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['UserName' => $UserName]);
  $user = $pdoResult->fetch();

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

    // Fetch all itinerary items for the current user
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
  <nav>
    <div class="logo">
      <i class="bx bx-menu menu-icon"></i>
      <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes"
        data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
        data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi" data-lang-pt="Caçador de viagens"
        data-lang-ar="صياد السفر">TravelHunter</span>


      <select class="language" id="language-select" onchange="changeLanguage()">
        <option value="en">English</option>
        <option value="es">Spanish</option>
        <option value="fr">French</option>
        <option value="de">German</option>
        <option value="zh">Chinese</option>
        <option value="jp">Japanese</option>
        <option value="ru">Russian</option>
        <option value="it">Italian</option>
        <option value="pt">Portuguese</option>
        <option value="ar">Arabic</option>
      </select>

    </div>
    <div class="sidebar">
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes"
          data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
          data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi" data-lang-pt="Caçador de viagens"
          data-lang-ar="صياد السفر">TravelHunter</span>
      </div>

      <div class="sidebar-content">
        <ul class="lists">
          <li class="list">
            <a href="../include/home.php" class="nav-link">
              <i class="bx bx-home-alt icon"></i>
              <span class="link" data-lang-en="Home" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
                data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Home</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/categories.html" class="nav-link">
              <i class="bx bx-menu icon"></i>
              <span class="link" data-lang-en="Categories" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Categories</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/place.html" class="nav-link">
              <i class="bx bx-map icon"></i>
              <span class="link" data-lang-en="Place" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Place</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/marketplace.html" class="nav-link">
              <i class="bx bx-gift icon"></i>
              <span class="link" data-lang-en="Marketplace" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Marketplace</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/social.html" class="nav-link">
              <i class="bx bx-camera icon"></i>
              <span class="link" data-lang-en="Social Media" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Social Media</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/whether.html" class="nav-link">
              <i class="bx bx-cloud icon"></i>
              <span class="link" data-lang-en="Whether Forecast" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Whether Forecast</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/itenerary.html" class="nav-link">
              <i class="bx bx-note icon"></i>
              <span class="link" data-lang-en="My Itinerary" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">My Itinerary</span>
            </a>
          </li>
        </ul>

        <div class="bottom-cotent">
          <li class="list">
            <a href="profile.php?id=<?php echo $user['id']; ?>" class="nav-link">
              <i class="bx bx-cog icon"></i>
              <span class="link" data-lang-en="Profile" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Profile</span>
            </a>
          </li>
          <li class="list">
            <a href="logout.php" class="nav-link">
              <i class="bx bx-log-out icon"></i>
              <span class="link" data-lang-en="Logout" data-lang-es="Cazador de viajes"
                data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
                data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
                data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Logout</span>
            </a>
          </li>
        </div>
      </div>
    </div>
  </nav>

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
        <input type="text" name="activity" placeholder="Activity" required>
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
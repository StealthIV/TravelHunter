<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("location: index.php");
  exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
  // Fetch user data
  $pdoQueryUser = "SELECT * FROM user WHERE UserName = :UserName";
  $pdoResultUser = $pdoConnect->prepare($pdoQueryUser);
  $pdoResultUser->execute(['UserName' => $UserName]);
  $user = $pdoResultUser->fetch();
  $profile_image = $user['image']; // Assuming this is the URL to the profile image
  $full_name = $user['FullName'];

  // Fetch places data
  $pdoQueryPlaces = "SELECT * FROM places";
  $pdoResultPlaces = $pdoConnect->prepare($pdoQueryPlaces);
  $pdoResultPlaces->execute();
  $places = $pdoResultPlaces->fetchAll(PDO::FETCH_ASSOC); // Fetch all places

} catch (PDOException $error) {
  echo $error->getMessage() . '';
  exit;
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
  <link rel="stylesheet" href="../style/place.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <?php require_once 'nav.php'; ?>
  <div class="search-box">
    <form>
      <button type="submit"><i class="fa fa-search"></i></button>
      <input type="text" id="search-box" placeholder="Search a place here..">
    </form>
  </div>
  <section class="overlay"></section>

  <section class="main">
    <!-- Modal for Image Preview -->
    <div id="imageModal" class="modal">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-content" id="modalImage" />
    </div>

    <section class="section3">
      <h1 style="color: white; font-size: 30px; margin-left: 50px;">Tourist Spots</h1>
      <div class="container1">
        <?php foreach ($places as $place): ?>
          <div class="card">
            <img src="<?php echo htmlspecialchars($place['image_url']); ?>"
              alt="Image of <?php echo htmlspecialchars($place['name']); ?>" class="clickable-image"
              onclick="openModal(this.src)" />
            <div class="intro">
              <h1><?php echo htmlspecialchars($place['name']); ?></h1>
              <p><?php echo htmlspecialchars($place['description']); ?></p>
              <p>Located in: <?php echo htmlspecialchars($place['location']); ?></p>
              <a class="location" href="<?php echo htmlspecialchars($place['map_link']); ?>"
                target="_blank">View Map</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

  </section>

  <script>
    function openModal(src) {
      const modal = document.getElementById("imageModal");
      const modalImage = document.getElementById("modalImage");
      modal.style.display = "block"; // Show the modal
      modalImage.src = src; // Set the image source
    }

    function closeModal() {
      const modal = document.getElementById("imageModal");
      modal.style.display = "none"; // Hide the modal
    }

    // Close modal when clicking anywhere outside of the image
    window.onclick = function(event) {
      const modal = document.getElementById("imageModal");
      if (event.target === modal) {
        closeModal();
      }
    }
  </script>


  <script src="../js/home.js"></script>
  <script src="../js/language.js"></script>
  <script src="../js/place.js"></script>
</body>

</html>
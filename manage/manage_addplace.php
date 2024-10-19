<?php
session_start();
require_once '../connect/dbcon.php'; // Adjust the path to your DB connection file

// Check if user is logged in (optional)
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: manage.php");
    exit();
}

// Handle form submissions for adding and updating tourist spots
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null; // Get id if available (for updates)
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $map_link = $_POST['map_link'];

    // Handle the image upload
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image_file']['tmp_name'];
        $imageName = $_FILES['image_file']['name'];
        $imageSize = $_FILES['image_file']['size'];
        $imageType = $_FILES['image_file']['type'];

        // Validate the image type (optional)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($imageType, $allowedTypes)) {
            echo "<script>alert('Only JPG, PNG and GIF files are allowed.');</script>";
            exit();
        }

        // Specify the upload directory
        $uploadDir = '../uploads/';
        $imagePath = $uploadDir . basename($imageName);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            if ($id) {
                // Update existing tourist spot
                $updateQuery = "UPDATE places SET name = ?, description = ?, image_url = ?, location = ?, map_link = ? WHERE id = ?";
                $stmt = $pdoConnect->prepare($updateQuery);
                $stmt->execute([$name, $description, $imagePath, $location, $map_link, $id]);
            } else {
                // Insert new tourist spot
                $insertQuery = "INSERT INTO places (name, description, image_url, location, map_link) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdoConnect->prepare($insertQuery);
                $stmt->execute([$name, $description, $imagePath, $location, $map_link]);
            }
            echo "<script>alert('Tourist spot saved successfully!');</script>";
            header("location: manage_place.php");

        } else {
            echo "<script>alert('There was an error uploading the image.');</script>";
        }
    } else {
        echo "<script>alert('Please upload an image file.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="../style/manage.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>M<span>angement</span></h3>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="">
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="req.php" class="active">
                        <span><i class="fa-solid fa-file-waveform"></i></span><br>
                        <small>Request</small>
                    </a>
                </li>
                <li>
                    <a href="boracayad.php">
                        <span><i class="fa-solid fa-file-waveform"></i></span><br>
                        <small>Announcement</small>
                    </a>
                </li>
                <li>
                    <a href="manage_edit.php">
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
                        <span><a href="logout.php"><i
                                    class="fa-solid fa-right-from-bracket"></i>Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <h1>Add Tourist Spots</h1>

                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                    <label>Name:</label>
                    <input type="text" name="name" required>
                    <label>Description:</label>
                    <textarea name="description" required></textarea>
                    <label>Image:</label>
                    <input type="file" name="image_file" accept="image/*" required>
                    <label>Location:</label>
                    <input type="text" name="location" required>
                    <label>Map Link:</label>
                    <input type="text" name="map_link">
                    <button type="submit">Save</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
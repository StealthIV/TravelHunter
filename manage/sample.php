<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: manage.php");
    exit();
}

require_once '../connect/dbcon.php';

$userId = $_SESSION['id'];  // Use session ID to fetch the user's data

try {
    // Fetch user information based on the session ID
    $pdoQuery = "SELECT * FROM user WHERE id = :id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute(['id' => $userId]);
    $user = $pdoResult->fetch();

    if (!$user) {
        echo "User not found.";
        exit;
    }
} catch (PDOException $error) {
    // Log the error (use error_log or a logging library)
    error_log($error->getMessage());
    echo "An error occurred while fetching data. Please try again later.";
    exit;
}

// Pagination settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total number of bookings
$totalBookingsQuery = $pdoConnect->prepare("SELECT COUNT(*) as totalBooking FROM bookings");
$totalBookingsQuery->execute();
$totalBookingResult = $totalBookingsQuery->fetch(PDO::FETCH_ASSOC);
$totalBookings = $totalBookingResult['totalBooking'];
$totalPages = ceil($totalBookings / $limit);

// Fetch bookings for the current page with user information
$pdoQuery = "
  SELECT bookings.*, user.FullName AS user_name, user.UserName AS user_email 
FROM bookings 
JOIN user ON bookings.user_id = user.id 
ORDER BY bookings.id DESC 
LIMIT :limit OFFSET :offset
";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoResult->bindParam(':limit', $limit, PDO::PARAM_INT);
$pdoResult->bindParam(':offset', $offset, PDO::PARAM_INT);
$pdoResult->execute();
$bookings = $pdoResult->fetchAll(PDO::FETCH_ASSOC);
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

<style>
main header {
            text-align: center;
            margin-top: 40px;
            font-size: 40px;
            color: white;
            -webkit-text-stroke: 4px greenyellow;
           
           
        }
       
        #admin-form label {
            font-weight: bold;
        }
        #admin-form  input, textarea {
            width: 50%;
            height: 40px;
           margin-right: 20px;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #admin-form button {
            padding: 10px 20px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #admin-form button:hover {
            background-color: #0056b3;
        }
        .preview-container {
            margin-top: 20px;
        }
        .preview-container img {
            max-width: 100%;
            max-height: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

       .bts {
            width: 150px;
        }

</style>

<body>

    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>M<span>agement</span></h3>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="manage.php" class="active">
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
                        <span><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="page-header">
                <h1>Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>

            
            <form id="admin-form">
            <label for="title">Page Title:</label>
            <input type="text" id="title" name="title" required><br>
            
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br>
            
            <div class="preview-container" id="preview-container" style="display:none;">
              
                <img id="image-preview" src="" alt="Image Preview">
            </div>

            <label for="history">Content Text:</label>
            <textarea id="history" name="history" required></textarea><br>
            
            <button type="submit">Update Content</button>
        </form>
           
        </main>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');

        // Show a preview of the uploaded image
        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                previewContainer.style.display = 'none';
            }
        });

        // Handle form submission
        document.getElementById('admin-form').addEventListener('submit', (e) => {
            e.preventDefault();

            const title = document.getElementById('title').value;
            const image = document.getElementById('image').files[0]; // Get the file input
            const history = document.getElementById('history').value;

            // Check if an image is uploaded
            if (image) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const imageData = e.target.result;
                    localStorage.setItem('title', title);
                    localStorage.setItem('image', imageData); // Store image as base64
                    localStorage.setItem('history', history);

                    alert('Content updated!');
                };
                reader.readAsDataURL(image); // Convert image to base64 for localStorage
            } else {
                localStorage.setItem('title', title);
                localStorage.setItem('history', history);

                alert('Content updated!');
            }
        });
    </script>

   
</body>

</html>
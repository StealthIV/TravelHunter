<?php
session_start();
require_once '../connect/dbcon.php'; // Adjust the path to your DB connection file

// Check if user is logged in (optional)
if (!isset($_SESSION["UserName"]) || !isset($_SESSION["id"])) {
    header("location: admin.php");
    exit();
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $deleteQuery = "DELETE FROM places WHERE id = ?";
    $stmt = $pdoConnect->prepare($deleteQuery);
    $stmt->execute([$id]);
}

// Pagination setup
$limit = 5; // Number of records to display per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Calculate offset

// Fetch total number of records
$totalQuery = "SELECT COUNT(*) FROM places";
$totalStmt = $pdoConnect->prepare($totalQuery);
$totalStmt->execute();
$totalSpots = $totalStmt->fetchColumn(); // Get total number of spots
$totalPages = ceil($totalSpots / $limit); // Calculate total pages

// Fetch tourist spots for the current page
$query = "SELECT * FROM places LIMIT :limit OFFSET :offset";
$stmt = $pdoConnect->prepare($query);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$touristSpots = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                    <a href="../crud/req.php" class="active">
                        <span><i class="fa-solid fa-file-waveform"></i></span> <br>
                        <small>Request</small>
                    </a>
                </li>
                <li>
                    <a href="../include/boracayad.php">
                        <span><i class="fa-solid fa-file-waveform"></i></span> <br>
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
                        <span><a href="../include/logout.php"><i
                                    class="fa-solid fa-right-from-bracket"></i>Logout</a></span>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <h1>Manage Tourist Spots</h1>

                <input style="margin: 20px 0px 0px 10px" type="text" id="search" placeholder="Search for tourist spots..." />

                <!-- Add Button -->
                <button  style="margin: 20px 0 20px 500px;"  onclick="window.location.href='manage_addplace.php'">
                    Add Tourist Spot
                </button>



                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image URL</th>
                            <th>Location</th>
                            <th>Map Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="spots-table-body">
                        <?php foreach ($touristSpots as $spot): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($spot['id']); ?></td>
                                <td><?php echo htmlspecialchars($spot['name']); ?></td>
                                <td><?php echo htmlspecialchars($spot['description']); ?></td>
                                <td>
                                    <img src="<?php echo htmlspecialchars($spot['image_url']); ?>"
                                        alt="<?php echo htmlspecialchars($spot['name']); ?>"
                                        style="width: 100px; height: auto;">
                                </td>
                                <td><?php echo htmlspecialchars($spot['location']); ?></td>
                                <td><?php echo htmlspecialchars($spot['map_link']); ?></td>
                                <td>
                                    <a href="?action=edit&id=<?php echo $spot['id']; ?>">Edit</a>
                                    <a href="?action=delete&id=<?php echo $spot['id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this spot?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" <?php if ($i == $page)
                               echo 'class="active"'; ?>><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                    <?php endif; ?>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#search').on('input', function () {
                        var searchTerm = $(this).val();

                        $.ajax({
                            url: 'searchtourist.php', // Create this file to handle search
                            type: 'GET',
                            data: { query: searchTerm },
                            success: function (data) {
                                $('#spots-table-body').html(data);
                            }
                        });
                    });
                });
            </script>

</body>

</html>
<?php
session_start();
require_once '../connect/dbcon.php'; // Adjust the path to your DB connection file

$searchTerm = isset($_GET['query']) ? $_GET['query'] : '';

// Fetch tourist spots that match the search term
$query = "SELECT * FROM places WHERE name LIKE :searchTerm LIMIT 5"; // Limit to 5 results
$stmt = $pdoConnect->prepare($query);
$stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
$touristSpots = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($touristSpots as $spot): ?>
    <tr>
        <td><?php echo $spot['id']; ?></td>
        <td><?php echo $spot['name']; ?></td>
        <td><?php echo $spot['description']; ?></td>
        <td>
            <img src="<?php echo $spot['image_url']; ?>" alt="<?php echo $spot['name']; ?>"
                style="width: 100px; height: auto;">
        </td>
        <td><?php echo $spot['location']; ?></td>
        <td><?php echo $spot['map_link']; ?></td>
        <td>
            <a href="?action=edit&id=<?php echo $spot['id']; ?>">Edit</a>
            <a href="?action=delete&id=<?php echo $spot['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this spot?');">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>

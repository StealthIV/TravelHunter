<?php
require_once '../connect/dbcon.php';
session_start();

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['UserName'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['id'];  // Ensure this matches your session variable for user ID
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

if ($post_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid post ID']);
    exit();
}

try {
    // Check if the user already liked the post
    $stmt = $pdoConnect->prepare("SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id");
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $like = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($like) {
        // If liked, remove the like
        $stmt = $pdoConnect->prepare("DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        echo json_encode(['status' => 'success', 'action' => 'unlike']);
    } else {
        // If not liked, add a new like
        $stmt = $pdoConnect->prepare("INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Add a notification for the like
        $notification_name = $_SESSION['FullName'] . ' liked your post';

        // Insert into notifications (leave status blank)
        $stmt = $pdoConnect->prepare("INSERT INTO notifications (name, post_id, user_id, created_at) VALUES (:name, :post_id, :user_id, NOW())");
        $stmt->bindParam(':name', $notification_name, PDO::PARAM_STR);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);  // Notify the post owner using 'user_id'
        $stmt->execute();

        echo json_encode(['status' => 'success', 'action' => 'like']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>

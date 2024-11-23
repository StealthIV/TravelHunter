<?php
require_once '../connect/dbcon.php';
session_start();

// Check if the user is logged in and the required POST parameters are set
if (isset($_SESSION['UserName']) && isset($_POST['post_id']) && isset($_POST['comment_text'])) {
    $user_id = $_SESSION['id'];  // Ensure this matches your session variable for user ID
    $post_id = intval($_POST['post_id']);
    $comment_text = trim($_POST['comment_text']);

    // Validate post ID and comment text
    if ($post_id <= 0 || empty($comment_text)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        exit();
    }

    try {
        // Insert comment into the database
        $stmt = $pdoConnect->prepare("INSERT INTO comments (post_id, user_id, comment_text) VALUES (:post_id, :user_id, :comment_text)");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment_text', $comment_text, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the post owner to notify the correct user
        $stmt = $pdoConnect->prepare("SELECT user_id FROM posts WHERE post_id = :post_id");  // Assuming post_id is the correct column
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        $postOwner = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($postOwner) {
            // Add a notification for the comment
            $notification_name = $_SESSION['FullName'] . ' commented on your post';
            $post_owner_id = $postOwner['user_id'];  // Get the post owner's user_id

            // Insert into notifications (leave status blank)
            $stmt = $pdoConnect->prepare("INSERT INTO notifications (name, post_id, user_id, created_at) VALUES (:name, :post_id, :user_id, NOW())");
            $stmt->bindParam(':name', $notification_name, PDO::PARAM_STR);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $post_owner_id, PDO::PARAM_INT);  // Notify the post owner using 'user_id'
            $stmt->execute();
        }

        echo json_encode(['status' => 'success']);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit();
}
?>

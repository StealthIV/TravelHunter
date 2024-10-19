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

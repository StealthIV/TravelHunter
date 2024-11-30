<?php
require_once '../connect/dbcon.php'; // Your database connection
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserName'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['post-text']) && !empty(trim($_POST['post-text']))) {
        // Retrieve and sanitize post data
        $post_text = htmlspecialchars(trim($_POST['post-text'])); // Sanitize input
        $user_id = $_SESSION['id']; // Use the correct session variable for user ID

        // Initialize file destination
        $file_destination = NULL;

        // Check if a file was uploaded
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Allowed file extensions
            $allowed_extensions = array("jpg", "jpeg", "png", "gif", "mp4", "avi", "mov");

            // Validate file extension
            if (in_array($file_ext, $allowed_extensions)) {
                // Check file size (e.g., max 10MB)
                if ($file_size <= 10 * 1024 * 1024) { // 10MB
                    // Generate a unique file name and move the uploaded file
                    $file_destination = "../uploads/" . uniqid('', true) . "." . $file_ext;
                    if (move_uploaded_file($file_tmp, $file_destination)) {
                        // File uploaded successfully
                    } else {
                        echo "Error: Failed to upload the file.";
                        exit();
                    }
                } else {
                    echo "Error: File size exceeds the maximum limit of 10MB.";
                    exit();
                }
            } else {
                echo "Error: Unsupported file format. Only jpg, jpeg, png, gif, mp4, avi, and mov are allowed.";
                exit();
            }
        }

        // Insert post into the database using prepared statements
        $sql = "INSERT INTO posts (user_id, post_text, post_image) VALUES (:user_id, :post_text, :post_image)";
        $stmt = $pdoConnect->prepare($sql);

        // Execute the statement
        if ($stmt->execute([
            ':user_id' => $user_id,
            ':post_text' => $post_text,
            ':post_image' => $file_destination
        ])) {
            // Add a notification for the new post
            $notification_name = $_SESSION['FullName'] . ' created a new post';
            $stmt = $pdoConnect->prepare("INSERT INTO notifications (name, user_id, post_id, created_at) VALUES (:name, :user_id, LAST_INSERT_ID(), NOW())");
            $stmt->bindParam(':name', $notification_name, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            // Execute the notification insertion
            $stmt->execute();

            // Redirect back to feed page
            header("Location: social.php");
            exit();
        } else {
            echo "Error: Failed to insert the post into the database.";
            exit();
        }
    } else {
        echo "Error: Post text is missing or empty.";
    }
}
?>

<?php
require_once '../connect/dbcon.php';    // Your database connection
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
        // Retrieve post data
        $post_text = trim($_POST['post-text']);
        $user_id = $_SESSION['id']; // Use the correct session variable for user ID

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
                // Generate a unique file name and move the uploaded file
                $file_destination = "../uploads/" . uniqid('', true) . "." . $file_ext;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    // File uploaded successfully
                } else {
                    echo "Error: Failed to upload the file.";
                    exit();
                }
            } else {
                echo "Error: Unsupported file format. Only jpg, jpeg, png, gif, mp4, avi, and mov are allowed.";
                exit();
            }
        } else {
            // No file uploaded
            $file_destination = NULL;
        }

        // Insert post into the database using prepared statements
        $sql = "INSERT INTO posts (user_id, post_text, post_image) VALUES (:user_id, :post_text, :post_image)";
        $stmt = $pdoConnect->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':post_text' => $post_text,
            ':post_image' => $file_destination
        ]);

        // Redirect back to feed page
        header("Location: social.php");
        exit();
    } else {
        echo "Error: Post text is missing or empty.";
    }
}
?>
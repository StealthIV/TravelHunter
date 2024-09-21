<?php
session_start();

// Check if user ID is posted
if (isset($_POST['userId'])) {
    $_SESSION['updateUserId'] = $_POST['userId'];

    // Redirect to the update page
    header("Location: set_update_session.php");
    exit();
} else {
    echo "No user ID found.";
    exit();
}
?>
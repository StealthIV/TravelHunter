<?php
session_start();

// Check if the ID is being passed via POST
if (isset($_POST['id'])) {
    $_SESSION['cancel_request_id'] = $_POST['id'];
    echo "Session ID set successfully."; // Optional: For debugging
} else {
    echo "No ID provided.";
}
?>

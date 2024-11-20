<?php
session_start();

// Check if the action and id are set
if (isset($_GET['id']) && isset($_GET['action'])) {
    $_SESSION['booking_id'] = $_GET['id'];
    $_SESSION['action'] = $_GET['action'];

    // Redirect based on the action type
    if ($_GET['action'] == 'confirm') {
        header("Location: update_status.php");
    } elseif ($_GET['action'] == 'delete') {
        header("Location: boracaydelete.php");
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Missing parameters.";
}
?>

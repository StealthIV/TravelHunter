<?php
session_start();
require_once '../connect/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = intval($_POST['userId']);

    try {
        $pdoQuery = "DELETE FROM user WHERE id = :id";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(['id' => $userId]);

        if ($pdoResult->rowCount() > 0) {
            // Redirect to manage.php after successful deletion
            header("Location:admin.php");
            exit();
        } else {
            echo "Failed to delete user.";
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
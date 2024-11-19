<?php
// Assume database connection is established

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['itinerary_id'])) {
  $activityId = $_POST['itinerary_id'];

  // Prepare and execute deletion query
  $stmt = $pdo->prepare("DELETE FROM itinerary WHERE id = ?");
  $stmt->execute([$activityId]);

  // Redirect back to the page or show a success message
  header("Location: itenerary.php"); // Change this to the actual page URL
  exit;
}
?>

<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("location: index.php");
  exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];
$user_id = $_SESSION['id']; // User ID from session

// Fetch user details
try {
  $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['UserName' => $UserName]);
  $user = $pdoResult->fetch();

  if (!$user) {
    echo "User not found.";
    exit();
  }

  // Extract user details
  $full_name = $user['FullName'];
  $email = $user['UserName'];
  $profile_image = !empty($user['image']) ? $user['image'] : 'img/default_profile.jpg'; // Default image
} catch (PDOException $error) {
  echo "Error: " . $error->getMessage();
  exit();
}

// Fetch user posts, likes count, and comments count
try {
  $stmt_posts = $pdoConnect->prepare("
    SELECT 
      posts.*, 
      (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.post_id) AS like_count,
      (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.post_id) AS comment_count
    FROM posts 
    WHERE user_id = :user_id 
    ORDER BY created_at DESC
  ");
  $stmt_posts->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt_posts->execute();
  $user_posts = $stmt_posts->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/profile.css">
  post-actions
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <title>Profile</title>
</head>

<body>
  <?php require_once 'nav.php'; ?>

  <section class="overlay"></section>

  <div class="account-details-box">
    <div class="profile-header">
      <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image">
      <div class="prof">
        <h2><?php echo htmlspecialchars($full_name); ?></h2>
        <p><?php echo htmlspecialchars($email); ?></p>
      </div>
    </div>

    <div class="profile-actions">
      <button class="edits" onclick="window.location.href='edit_profile.php'">Edit Profile</button>
    </div>

    <div class="user-posts">
      <h3>Your Posts</h3>
      <?php if (!empty($user_posts)): ?>
        <?php foreach ($user_posts as $post): ?>
          <div class="post">
            <h4><?php echo htmlspecialchars($post['post_text']); ?></h4>
            <?php if (!empty($post['post_image'])): ?>
              <img src="<?php echo htmlspecialchars($post['post_image']); ?>" alt="Post Image" style="max-width: 100%; border-radius: 5px;">
            <?php endif; ?>
            <span class="post-date"><?php echo htmlspecialchars(date("F j, Y, g:i a", strtotime($post['created_at']))); ?></span>

            <div class="post-actions">
              <!-- Like Button -->
              <button class="like-btn" data-post-id="<?php echo $post['post_id']; ?>">
                <i class="bx bx-heart"></i> <span><?php echo $post['like_count']; ?></span> Likes
              </button>
              <!-- Comment Button -->
              <button class="comment-btn" data-post-id="<?php echo $post['post_id']; ?>">
                <i class="bx bx-comment"></i> <span><?php echo $post['comment_count']; ?></span> Comments
              </button>
            </div>

            <div class="comment-section" id="comment-section-<?php echo $post['post_id']; ?>" style="display: none;">
              <textarea placeholder="Add a comment..." class="comment-input"></textarea>
              <button class="submit-comment" data-post-id="<?php echo $post['post_id']; ?>">Post</button>
              <div class="existing-comments">
                <!-- Comments will be loaded dynamically here -->
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>You have no posts yet.</p>
      <?php endif; ?>
    </div>
  </div>

  <script src="../js/home.js"></script>
  <script src="../js/language.js"></script>
</body>

</html>

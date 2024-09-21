<?php
require_once '../connect/dbcon.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['UserName'])) {
  $user_id = $_SESSION['id'];

  try {
    // Fetch the user's details including profile_image from the database using user_id
    $stmt = $pdoConnect->prepare("SELECT FullName, image FROM user WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $first_name = $user['FullName'];
      $profile_image = $user['image']; // Assuming this is the URL to the profile image
    } else {
      // Handle the case where user details are not found
      $first_name = "UserName";
      $last_name = "";
      $profile_image = "../uploads/default.jpg"; // Default image path if profile_image is not set
    }

    // Retrieve posts from the database randomly
    $sql = "
          SELECT 
              posts.*,  user.FullName,  user.image,  posts.created_at, 
              (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.post_id) AS like_count,
              (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.post_id) AS comment_count
          FROM 
              posts 
          JOIN 
              user ON posts.user_id = user.id 
          ORDER BY 
              RAND()";

    $stmt = $pdoConnect ->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


  } catch (PDOException $e) {
    // Handle database connection error or query failure
    echo "Error: " . $e->getMessage();
    exit();
  }
} else {
  // Redirect to the login page if the user is not logged in
  header("Location: login.php");
  exit();
}

$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

if ($post_id > 0) {
  try {
    // Check if the user already liked the post
    $stmt = $pdoConnect ->prepare("SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id");
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $like = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($like) {
      // If liked, remove the like
      $stmt = $pdoConnect ->prepare("DELETE FROM likes WHERE like_id = :like_id");
      $stmt->bindParam(':like_id', $like['like_id'], PDO::PARAM_INT);
      $stmt->execute();
      echo json_encode(['status' => 'success', 'action' => 'unlike']);
    } else {
      // If not liked, add a new like
      $stmt = $pdoConnect ->prepare("INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)");
      $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      echo json_encode(['status' => 'success', 'action' => 'like']);
    }
  } catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
  }
}

// Function to calculate and format time difference
function getTimeElapsed($datetime)
{
  $current_time = new DateTime();  // Current time
  $created_time = new DateTime($datetime);  // Time the post was created
  $interval = $current_time->diff($created_time);  // Difference between current time and created time

  if ($interval->y >= 1) {
    return $interval->format('%y year' . ($interval->y > 1 ? 's' : '') . ' ago');
  } elseif ($interval->m >= 1) {
    return $interval->format('%m month' . ($interval->m > 1 ? 's' : '') . ' ago');
  } elseif ($interval->d >= 1) {
    return $interval->format('%d day' . ($interval->d > 1 ? 's' : '') . ' ago');
  } elseif ($interval->h >= 1) {
    return $interval->format('%h hour' . ($interval->h > 1 ? 's' : '') . ' ago');
  } elseif ($interval->i >= 1) {
    return $interval->format('%i minute' . ($interval->i > 1 ? 's' : '') . ' ago');
  } else {
    return 'just now';  // If less than a minute ago
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Hunter</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../style/itenerary.css">
  <link rel="stylesheet" href="styles/feed.css">
  

  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

</head>

<body>
  
<?php require_once 'nav.php'?>

  <section class="overlay"></section>

  <Section class="main">

    <div class="containers">
      <div class="post-form">
        <form action="post.php" method="post" enctype="multipart/form-data">
          <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Picture" id="user">
          <textarea name="post-text" id="post-text" placeholder="Write something..."></textarea>
          <input type="file" name="file" id="file" accept="image/*, video/*">
          <button type="submit">Post</button>
        </form>
      </div>

      <div class="post-container">
        <?php if (empty($posts)): ?>
          <p>No posts available at the moment.</p>
        <?php else: ?>
          <?php foreach ($posts as $post): ?>
            <div class="post">
              <div id="profile">
                <!-- Display user profile picture and name -->
                <?php
                // Fallback to default profile image if not available
                $profile_image = !empty($post['image']) ? htmlspecialchars($post['image']) : '../uploads/default.jpg';
                ?>
                <img id="profile_img" src="<?php echo $profile_image; ?>" alt="Profile Picture">
                <h3>
                  <?php echo htmlspecialchars($post['FullName']); ?>
                </h3>
                <button type="button" class="btn-close" disabled aria-label="Close"></button>

                <span id="timestamp"><?php echo htmlspecialchars(getTimeElapsed($post['created_at'])); ?></span>
              </div>
              <div class="post-content">
                <!-- Display post text above the post image -->
                <p><?php echo htmlspecialchars($post['post_text']); ?></p>
                <?php if (!empty($post['post_image'])): ?>
                  <!-- Display post image if available -->
                  <div class="post-image-container">
                    <img src="<?php echo htmlspecialchars($post['post_image']); ?>" alt="Post Image" class="post-image">
                  </div>
                <?php endif; ?>
              </div>

              <div class="post-actions">
                <?php
                // Check if the user has already liked the post
                $stmt = $pdoConnect ->prepare("SELECT COUNT(*) FROM likes WHERE post_id = :post_id AND user_id = :user_id");
                $stmt->bindParam(':post_id', $post['post_id'], PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $isLiked = $stmt->fetchColumn() > 0;
                ?>
                <button class="like-button <?php echo $isLiked ? 'liked' : ''; ?>"
                  data-post-id="<?php echo htmlspecialchars($post['post_id']); ?>">
                  <i class="<?php echo $isLiked ? 'fas' : 'far'; ?> fa-thumbs-up"></i>
                  <?php echo $isLiked ? 'Unlike' : 'Like'; ?> (<span
                    class="like-count"><?php echo htmlspecialchars($post['like_count']); ?></span>)
                </button>

                <!-- Comment toggle button and comment count -->
                <button class="comment-toggle-button">
                  <i class="far fa-comment"></i> <span class="comment-action-text">Comment</span> (<span
                    class="comment-count"><?php echo htmlspecialchars($post['comment_count']); ?></span>)
                </button>

                <!-- Container to display comments (initially hidden) -->
                <div class="comments-container" style="display: none;">
                  <?php
                  // Fetch comments for the current post, including user info and profile image
                  $stmt = $pdoConnect ->prepare("
    SELECT comments.*, user.FullName, user.image 
    FROM comments 
    JOIN user ON comments.user_id = user.id 
    WHERE comments.post_id = :post_id 
    ORDER BY comments.created_at DESC
");
                  $stmt->bindParam(':post_id', $post['post_id'], PDO::PARAM_INT);
                  $stmt->execute();
                  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  if (!empty($comments)) {
                    foreach ($comments as $comment) {
                      echo '<div class="comment">';
                      echo '<div class="comment-author">';

                      // Display profile image (fallback to a default image if not available)
                      $profile_image = !empty($comment['image']) ? htmlspecialchars($comment['image']) : 'img/default_profile.jpg';
                      echo '<img src="' . $profile_image . '" alt="Profile Picture" class="comment-profile-img">';

                      // Display the full name of the commenter
                      echo '<strong>' . htmlspecialchars($comment['FullName']) . '</strong>';
                      echo '</div>';

                      // Display the comment text
                      echo '<div class="comment-text">';
                      echo htmlspecialchars($comment['comment_text']);
                      echo '</div>';
                      echo '</div>';
                    }
                  } else {
                    echo '<p class="no-comments">No comments yet.</p>';
                  }
                  ?>


                  <!-- Form to add new comment -->
                  <form class="comment-form" style="display: none;"
                    data-post-id="<?php echo htmlspecialchars($post['post_id']); ?>">
                    <div class="comment-form-inner">
                      <textarea name="comment-text" class="comment-textarea" placeholder="Write a comment..."
                        required></textarea>
                      <button type="submit" class="comment-submit-btn">Post</button>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          <?php endforeach; ?>

        <?php endif; ?>
      </div>

      <script>
        //like function ffr
        document.addEventListener('DOMContentLoaded', function () {
          const likeButtons = document.querySelectorAll('.like-button');

          likeButtons.forEach(button => {
            button.addEventListener('click', function () {
              const postId = this.getAttribute('data-post-id');
              const likeCountElement = this.querySelector('.like-count');
              const icon = this.querySelector('i');

              fetch('like.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `post_id=${postId}`
              })
                .then(response => response.json())
                .then(data => {
                  if (data.status === 'success') {
                    if (data.action === 'like') {
                      likeCountElement.textContent = parseInt(likeCountElement.textContent) + 1;
                      this.classList.add('liked');
                      icon.classList.remove('far');
                      icon.classList.add('fas');
                      this.innerHTML = '<i class="fas fa-thumbs-up"></i> Unlike (<span class="like-count">' + likeCountElement.textContent + '</span>)';
                    } else if (data.action === 'unlike') {
                      likeCountElement.textContent = parseInt(likeCountElement.textContent) - 1;
                      this.classList.remove('liked');
                      icon.classList.remove('fas');
                      icon.classList.add('far');
                      this.innerHTML = '<i class="far fa-thumbs-up"></i> Like (<span class="like-count">' + likeCountElement.textContent + '</span>)';
                    }
                  } else {
                    alert(data.message);
                  }
                })
                .catch(error => console.error('Error:', error));
            });
          });
        });
      </script>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const commentToggleButtons = document.querySelectorAll('.comment-toggle-button');

          commentToggleButtons.forEach(button => {
            button.addEventListener('click', function () {
              const commentsContainer = this.nextElementSibling; // Get the next element, which is the comments container
              const commentForm = commentsContainer.querySelector('.comment-form');

              if (commentsContainer.style.display === 'none') {
                // Show comments container and comment form
                commentsContainer.style.display = 'block';
                commentForm.style.display = 'block';
                this.querySelector('.comment-action-text').textContent = 'Hide'; // Change button text to Hide
              } else {
                // Hide comments container and comment form
                commentsContainer.style.display = 'none';
                commentForm.style.display = 'none';
                this.querySelector('.comment-action-text').textContent = 'Comment'; // Change button text to Comment
              }
            });
          });

          // Add event listener for comment submission
          const commentForms = document.querySelectorAll('.comment-form');

          commentForms.forEach(form => {
            form.addEventListener('submit', function (event) {
              event.preventDefault();
              const postId = this.getAttribute('data-post-id');
              const commentText = this.querySelector('textarea[name="comment-text"]').value.trim();

              if (commentText === '') {
                alert('Please enter a comment.');
                return;
              }

              fetch('comment.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `post_id=${postId}&comment_text=${encodeURIComponent(commentText)}`
              })
                .then(response => response.json())
                .then(data => {
                  if (data.status === 'success') {
                    // Assuming you want to refresh the page after posting a comment
                    location.reload();
                  } else {
                    alert(data.message);
                  }
                })
                .catch(error => console.error('Error:', error));
            });
          });
        });

      </script>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"></script>
  </Section>

  <script src="../js/home.js"></script>
  <script src="../js/language.js"></script>
  <script src="../js/itenerary.js"></script>
</body>

</html>
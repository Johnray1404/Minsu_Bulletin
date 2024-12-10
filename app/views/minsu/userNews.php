<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - MINSU News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/userNews.css">
</head>
<body>
<div class="header">
    <img src="public/images/minsu.jpg" alt="MINSU Logo">
    <div class="nav-links">
        <a class="nav-link" href="/home"><i class="fas fa-home"></i>Home</a>
        <a class="nav-link" href="/userNews"><i class="fas fa-newspaper"></i>News</a>
        <a class="nav-link" href="/post"><i class="fas fa-pen"></i> Post</a>
        <a class="nav-link" href="/gallery"><i class="fas fa-image"></i>Gallery</a>
        <a class="nav-link" href="/contact"><i class="fas fa-envelope"></i>Contact</a>
    </div>
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search here">
    </div>

    <div class="user-profile">
        <?php if (!empty($user['profile_pic'])): ?>
            <img src="public/<?php echo $user['profile_pic']; ?>" alt="Profile Picture" class="profile-img" onclick="toggleDropdown()" />
        <?php else: ?>
            <i class="fas fa-user-circle profile-icon" onclick="toggleDropdown()"></i>
        <?php endif; ?>

        <div class="dropdown-menu" id="dropdownMenu">
            <a href="/userProfile">User Profile</a>
            <a href="#" onclick="confirmLogout()">Logout</a>
        </div>
    </div>
</div>

    <!-- userNews.php -->
<div class="main">
    <div class="breaking-news">Breaking News: Major updates from MINSU News Bulletin!</div><br>

    <div class="news-feed-container">
    <?php if (!empty($news_posts)): ?>
        <?php foreach ($news_posts as $post): ?>
            <div class="post">
                <!-- Post Header -->
                <div class="post-header">
                    <div class="post-user-info">
                        <img src="public/images/minsu.jpg" alt="Admin Profile" class="post-user-image">
                        <div class="post-user-name">
                            <strong>MINSU</strong>
                        </div>
                    </div>
                    <div class="post-time">
                        <i class="fas fa-clock"></i>
                        <span><?= $time_ago($post['created_at']) ?></span>
                    </div>
                </div>

                <!-- Post Title and Caption -->
                <div class="post-title">
                    <h1><?= htmlspecialchars($post['title']) ?></h1>
                </div>
                <div class="post-caption">
                    <p><strong><?= htmlspecialchars($post['caption']) ?></strong></p>
                </div>

                <!-- Post Media -->
                <div class="post-media-container">
                    <?php if (!empty($post['image'])): ?>
                        <div class="post-image-container">
                            <img src="public/<?= $post['image'] ?>" alt="Post Image" class="main-post-image">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($post['video'])): ?>
                        <div class="post-video-container">
                            <video controls class="main-post-video">
                                <source src="public/<?= $post['video'] ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Like Button Section -->
                <div class="like-section">
                    <div class="like-button <?= $post['user_liked'] ? 'liked' : '' ?>" onclick="toggleLike(<?= $post['id'] ?>, this)">
                        <i class="fas fa-thumbs-up"></i>
                        Like
                    </div>
                    <span class="like-count"><?= $post['like_count'] ?> likes</span> <!-- This will be updated dynamically with JS -->
                </div>

                <!-- Comments Section -->
                <div class="comments-section">
                    <div class="comments-header">
                        <h3>Comments (<?= count($post['comments']) ?>)</h3>
                        <button class="toggle-comments-btn" onclick="toggleComments(<?= $post['id'] ?>)">Show Comments</button>
                    </div>
                    
                    <div class="comments-list" id="comments-list-<?= $post['id'] ?>" style="display: none;">
                        <?php if (!empty($post['comments'])): ?>
                            <ul>
                                <?php foreach ($post['comments'] as $comment): ?>
                                    <li class="comment-item">
                                        <div class="comment-user">
                                            <!-- Display the user's profile picture -->
                                            <img src="public/<?= !empty($comment['profile_pic']) ? $comment['profile_pic'] : 'images/default-profile.png' ?>" 
                                                alt="<?= htmlspecialchars($comment['username']) ?>'s Profile Picture" 
                                                class="comment-user-image">
                                            <strong><?= htmlspecialchars($comment['username']) ?></strong>
                                        </div>
                                        <div class="comment-content">
                                            <p><?= htmlspecialchars($comment['comment']) ?></p>
                                            <span class="comment-time"><?= $time_ago($comment['created_at']) ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No comments yet.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Add Comment Form -->
                    <div class="comment-form">
                        <form action="/minsu/add_comment" method="POST">
                            <textarea name="comment" placeholder="Add a comment..." required></textarea>
                            <input type="hidden" name="news_id" value="<?= $post['id'] ?>">
                            <button type="submit">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No news posts available at the moment.</p>
    <?php endif; ?>
</div>


</div>
<footer>
    <p>&copy; 2024 MINSU News Bulletin. All Rights Reserved.</p>
</footer>
<script>
    function toggleLike(newsId, button) {
     console.log("Toggling like for post ID:", newsId); // Check if this is triggered
     const userId = <?= $_SESSION['user_id']; ?>;  // Assuming user ID is available in the session
     console.log("User ID:", userId);  // Log user ID for debugging

     // Make AJAX request to server
     fetch('/minsu/toggle_like', {
         method: 'POST',
         headers: {
             'Content-Type': 'application/x-www-form-urlencoded',
         },
         body: `news_id=${newsId}&user_id=${userId}`  // Send news_id and user_id in request body
     })
     .then(response => {
         console.log("Response status:", response.status);  // Debugging: Check response status
         return response.json();
     })
     .then(data => {
         console.log("Response from server:", data);  // Debugging: Check the returned data

         if (data.status === 'success') {
             // Toggle the like button state
             button.classList.toggle('liked');
             console.log("Like toggled for post ID:", newsId);  // Debugging: Confirm like toggle

             // Update the like count
             const likeCountElem = button.nextElementSibling;
             likeCountElem.textContent = `${data.like_count} likes`;  // Update like count
         } else {
             console.log("Error: Could not toggle like.");
         }
     })
     .catch(error => {
         console.log("Error with fetch request:", error);  // Debugging: Log any error with the fetch request
     });
 }

    function toggleDropdown() {
        document.getElementById("dropdownMenu").classList.toggle("show");
    }

    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "/logout";
        }
    }

    function toggleComments(postId) {
    const commentsList = document.getElementById(`comments-list-${postId}`);
    const toggleButton = commentsList.previousElementSibling.querySelector('.toggle-comments-btn');

    // Toggle the visibility of comments
    if (commentsList.style.display === 'none') {
        commentsList.style.display = 'block';
        toggleButton.textContent = 'Hide Comments';
    } else {
        commentsList.style.display = 'none';
        toggleButton.textContent = 'Show Comments';
    }
}

</script>
</body>
</html>

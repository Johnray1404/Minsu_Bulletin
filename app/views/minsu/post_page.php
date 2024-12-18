<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post - MINSU News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/post_page.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<div class="main">
<div class="main">
    <!-- Add Post Button -->
    <a href="/get-post" class="add-post-button"><i class="fas fa-plus-circle"></i> Add Post</a>
    <div class="post-list">
        <?php if (!empty($news_posts)): ?>
            <?php foreach ($news_posts as $post): ?>

                <div class="post-container">
                    <div class="post-header">
                        <i class="fas fa-user-circle" style="font-size: 40px; color: var(--primary-color);"></i>
                        <div class="post-info" style="display: inline-block; margin-left: 15px;">
                        <span class="username" style="font-size: 18px; font-weight: 600;">User</span>

                            <div class="post-meta">
                                <span class="clock"><i class="fas fa-clock"></i></span>
                                <span><?php echo $time_ago($post['created_at']); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="post-title">
                        <h1><?php echo htmlspecialchars($post['post_title']); ?></h1>
                    </div>

                    <div class="post-content">
                        <p><?php echo nl2br(htmlspecialchars($post['post_caption'])); ?></p>

                        <?php if (!empty($post['post_mediafile'])): ?>
                            <div class="post-media">
                                <img src="public/<?php echo htmlspecialchars($post['post_mediafile']); ?>" alt="Post Media" style="max-width: 100%; height: auto;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="like-section">
                        <div class="like-button <?= $post['user_liked'] ? 'liked' : '' ?>" onclick="togglePostLike(<?= $post['id'] ?>, this)">
                            <i class="fas fa-thumbs-up"></i>
                            Like
                        </div>
                        <span id="like-count-<?= $post['id'] ?>"><?= $post['like_count'] ?> likes</span>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section">
                        <div class="comments-header">
                            <h3>Comments</h3>

                            <!-- Show Comments Button -->
                            <button class="toggle-comments-btn" id="toggle-comments-btn-<?= $post['id'] ?>" onclick="toggleComments(<?= $post['id'] ?>)">
                                Show Comments
                            </button>
                        </div>

                        <!-- Comments List -->
                        <div class="comments-list" id="comments-list-<?= $post['id'] ?>">
                            <?php if (!empty($post['comments'])): ?>
                                <?php foreach ($post['comments'] as $comment): ?>
                                    <div class="comment-item">
                                        <div class="comment-user-info">
                                            <img src="public/<?php echo htmlspecialchars($comment['profile_pic'] ?? 'images/default-profile.png'); ?>" alt="Profile Picture" class="comment-user-image">
                                            <strong class="comment-user"><?php echo htmlspecialchars($comment['username']); ?></strong>
                                        </div>
                                        <div class="comment-content">
                                            <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                                            <span class="comment-time"><?php echo $comment['created_at']; ?></span> <!-- Output the raw timestamp -->
                                            
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No comments yet.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Comment form -->
                        <form action="/post_comment" method="POST" class="comment-form">
                            <textarea name="comment" placeholder="Write a comment..." required></textarea>
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <button type="submit">Post Comment</button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found!</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>© 2024 MINSU News Bulletin. All rights reserved.</p>
</footer>

<script>
    // Toggle Comments Visibility
    function toggleComments(postId) {
        var commentsList = document.getElementById('comments-list-' + postId);
        var toggleButton = document.getElementById('toggle-comments-btn-' + postId);

        // Toggle visibility of comments with transition
        if (commentsList.style.display === 'none' || commentsList.style.display === '') {
            commentsList.style.display = 'block';
            toggleButton.innerHTML = 'Hide Comments';
        } else {
            commentsList.style.display = 'none';
            toggleButton.innerHTML = 'Show Comments';
        }
    }

    // Toggle the dropdown menu for user profile
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('show');
    }

    // Confirm logout action
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "/"; // Redirect to login page
        }
    }

    function togglePostLike(postId, element) {
        const userId = <?= $_SESSION['user_id']; ?>;  // Get the logged-in user's ID

        // Make AJAX request to toggle the like
        $.post('/minsu/toggle_post_like', { post_id: postId, user_id: userId }, function(response) {
            const result = JSON.parse(response);  // Ensure the response is correctly formatted
            const likeCountElement = $('#like-count-' + postId); // Reference to the like count element

            // If the like was successfully added or removed
            if (result.status === 'success') {
                // Update button state
                if (result.action === 'added') {
                    $(element).addClass('liked'); // Add 'liked' class to button
                } else if (result.action === 'removed') {
                    $(element).removeClass('liked'); // Remove 'liked' class from button
                }

                // Update the like count
                likeCountElement.text(result.like_count + ' likes');
            } else {
                console.error('An error occurred:', result.message);
            }
        }).fail(function() {
            console.error("AJAX request failed");
        });
    }
</script>
</body>
</html>
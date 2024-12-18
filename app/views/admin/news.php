<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/admin.css">
    <link rel="stylesheet" href="/public/styles/news.css">
</head>
<body>

<div class="sidebar">
    <img src="/public/images/minsu.jpg" alt="MINSU Logo">
    <a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="/admin/news"><i class="fas fa-newspaper"></i> News</a>
    <a href="/admin/accounts"><i class="fas fa-users-cog"></i> User Accounts</a>
</div>

<div class="main-content">
    <div class="header">
        <h1>Admin News</h1>
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        <div class="user-profile">
            <i class="fas fa-user-circle"></i>
            <div class="dropdown-menu">
                <a href="#">Admin <i class="fas fa-user-shield"></i></a>
                <a href="#" onclick="confirmLogout()">Logout <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>

    <h2>News Posts</h2>

    <!-- Button to Post News -->
    <a href="/admin/post_news" class="btn-post-news">
        <button class="btn btn-primary">Post News</button>
    </a>

    <!-- In views/admin/news.php -->
    <div class="news-container">
    <?php if (isset($news_posts) && !empty($news_posts)): ?>
        <?php foreach ($news_posts as $news): ?>
            <div class="news-post">
                <div class="post-header">
                    <div class="post-user-info">
                        <img src="/public/images/minsu.jpg" alt="Admin Profile" class="post-user-image">
                        <div class="post-user-name">
                            <strong>MINSU</strong>
                        </div>
                        <div class="post-time">
                            <i class="fas fa-clock"></i>
                            <span><?= $time_ago($news['created_at']) ?></span>
                        </div>
                    </div>
                </div>

                <h3><?php echo htmlspecialchars($news['title'] ?? 'No Title'); ?></h3>
                <p><?php echo htmlspecialchars($news['caption'] ?? 'No caption available'); ?></p>

                <?php if (!empty($news['image'])): ?>
                    <img src="/public/<?php echo htmlspecialchars($news['image']); ?>" alt="News Image">
                <?php endif; ?>

                <?php if (!empty($news['video'])): ?>
                    <video width="320" height="240" controls>
                        <source src="/public/<?php echo htmlspecialchars($news['video']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>

                <div class="like-section">
                    <span class="like-count"><?php echo $news['like_count']; ?> likes</span>
                </div>

                <!-- Comment Section HTML -->
                <div class="comments-section">
                    <h4>Comments (<?= count($news['comments']) ?>)</h4>

                    <!-- Toggle button for showing/hiding comments -->
                    <button class="toggle-comments-btn" id="toggle-btn-<?= $news['id']; ?>" onclick="toggleComments(<?= $news['id']; ?>)">
                        Show Comments
                    </button>

                    <?php if (!empty($news['comments'])): ?>
                        <div class="comments-list" id="comments-list-<?= $news['id']; ?>" style="display: none;">
                            <?php foreach ($news['comments'] as $comment): ?>
                                <div class="comment-item">
                                    <div class="comment-user-info">
                                        <div class="comment-user-image-container">
                                            <img src="/public/<?= !empty($comment['profile_pic']) ? $comment['profile_pic'] : 'images/default-profile.png' ?>" 
                                                 alt="<?= htmlspecialchars($comment['username']) ?>'s Profile Picture" 
                                                 class="comment-user-image">
                                        </div>
                                        <div class="comment-user">
                                            <strong><?= htmlspecialchars($comment['username']) ?></strong>
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        <p><?= htmlspecialchars($comment['comment']) ?></p>
                                        <span class="comment-time"><?= $time_ago($comment['created_at']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No comments yet.</p>
                    <?php endif; ?>
                </div>

                <!-- Delete Button (always visible for now) -->
                <form action="/admin/delete_news/<?= $news['id']; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this news post?')">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Show message if there are no news posts -->
        <p><?php echo isset($no_news_message) ? $no_news_message : 'No news available.'; ?></p>
    <?php endif; ?>
</div>

</div>

<script>
    document.querySelector('.user-profile').addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        event.stopPropagation();
    });

    function confirmLogout() {
        var userConfirm = confirm("Are you sure you want to log out?");
        if (userConfirm) {
            window.location.href = "/logout";
        }
    }

    // Function to toggle the visibility of comments
    function toggleComments(newsId) {
        var commentsList = document.getElementById('comments-list-' + newsId);
        var toggleButton = document.getElementById('toggle-btn-' + newsId);

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

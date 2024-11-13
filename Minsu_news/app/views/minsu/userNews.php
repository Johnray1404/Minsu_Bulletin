<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - MINSU News Bulletin</title>
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="header">
    <img src="public/images/minsu.jpg" alt="MINSU Logo">
    <div class="nav-links">
        <a class="nav-link" href="/home"><i class="fas fa-home"></i>Home</a>
        <a class="nav-link" href="/news"><i class="fas fa-newspaper"></i>News</a>
        <a class="nav-link" href="/blog"><i class="fas fa-blog"></i>Blog</a>
        <a class="nav-link" href="/gallery"><i class="fas fa-image"></i>Gallery</a>
        <a class="nav-link" href="/contact"><i class="fas fa-envelope"></i>Contact</a>
    </div>
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search here">
    </div>

    <!-- User Profile Icon and Dropdown -->
    <div class="user-profile">
        <i class="fas fa-user-circle" onclick="toggleDropdown()"></i>
        <div class="dropdown-menu" id="dropdownMenu">
            <a href="/profile">User Profile</a>
            <a href="/change-password">Change Password</a>
            <a href="#" onclick="confirmLogout()">Logout</a>
        </div>
    </div>
</div>

<div class="main">
    <div class="breaking-news">Breaking News: Major updates from MINSU News Bulletin!</div><br>

    <!-- Container for News Posts -->
    <div class="news-feed-container">
        <?php if (!empty($news_posts)): ?>
            <?php foreach ($news_posts as $post): ?>
                <div class="post">
                    <!-- Post Header: Profile Image and Admin Name -->
                    <div class="post-header">
                        <div class="post-user-info">
                            <img src="public/images/minsu.jpg" alt="Admin Profile" class="post-user-image">
                            <div class="post-user-name">
                                <strong>MINSU</strong> 
                            </div>
                        </div>
                        <span class="post-time"><?= $time_ago($post['created_at']) ?></span>
                    </div>

                    <!-- Post Title -->
                    <div class="post-title">
                        <h1><?= htmlspecialchars($post['title']) ?></h1> 
                    </div>

                    <!-- Post Caption -->
                    <div class="post-caption">
                        <p><strong><?= htmlspecialchars($post['caption']) ?></strong></p>
                    </div>

                    <!-- Post Image -->
                    <div class="post-image-container">
                        <img src="public/<?= $post['image'] ?>" alt="Post Image" class="main-post-image">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No news posts available at the moment.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>© 2024 MINSU News Bulletin. All rights reserved.</p>
    </footer>
</div>

<script>
    // Toggle the dropdown menu for user profile
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('show');
    }

    // Confirm logout action
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "/"; 
        }
    }
</script>

</body>
</html>

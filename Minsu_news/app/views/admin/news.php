<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/admin.css">
</head>
<body>

<div class="sidebar">
    <img src="/public/images/minsu.jpg" alt="MINSU Logo">
    <a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="/admin/news"><i class="fas fa-newspaper"></i> News</a>
    <a href="/postrequest"><i class="fas fa-edit"></i> PostRequest</a>
    <a href="/manageaccount"><i class="fas fa-users-cog"></i> Manage Account</a>
</div>

<div class="main-content">
    <div class="header">
        <h1>Admin Dashboard</h1>
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

    <br><br><br>
    <h2>News Posts</h2><br><br>
     <!-- Button to Post News -->
     <a href="/admin/post_news" class="btn-post-news">
            <button class="btn btn-primary">Post News</button>
        </a><br>
        <div class="news-container"> <!-- Changed class name to .news-container -->
    <?php if (isset($news_posts) && !empty($news_posts)): ?>
        <?php foreach ($news_posts as $news): ?>
            <div class="news-post">
                <h3><?php echo htmlspecialchars($news['title']); ?></h3>
                <p><?php echo htmlspecialchars($news['content']); ?></p>
                <!-- Correct the image path -->
                <img src="/public/<?php echo htmlspecialchars($news['image']); ?>" alt="News Image">
                <p><em><?php echo htmlspecialchars($news['caption']); ?></em></p>
                <a href="/admin/view_news/<?php echo $news['id']; ?>">Read more</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No news available.</p>
    <?php endif; ?>
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
</script>

</body>
</html>
